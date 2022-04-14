import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { __experimentalHeading as Heading, PanelBody, SelectControl, __experimentalInputControl as InputControl, Button, __experimentalNumberControl as NumberControl, ToggleControl, __experimentalUnitControl as UnitControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import icons from '../../icons/icons';
import Style from 'style-it';

registerBlockType( 'category-post-view/post-group', {
	title: __( 'Post Group' ),
	description: __( 'Block showing a group of posts.' ),
	icon: icons.postlayoutsicn,
	category: 'text',
	keywords: [ __( 'latest' ), __( 'posts' ), __( 'grid' ) ],
	example: {
		attributes: {
			author: 'Forhad',
		},
	},

	edit({ clientId, attributes, setAttributes }) {

		const {
			id,
			groupImage,
			groupImageObj,
			groupImageSize,
			isEqualHeight,
			groupImageHeight,
			theCategories,
			groupTitle,
			postsPerPage,
			titleWordCount
		} = attributes;

		/**
		 * Set unique ID through block index.
		 */
		// let blockIndex = wp.data.select( 'core/block-editor' ).getBlockIndex( clientId );
		// setAttributes({ id: blockIndex });
		let clientIdSliced = clientId.slice(clientId.lastIndexOf('-') + 1); // Get the last part.
		setAttributes({ id: clientIdSliced }); // The Block ID.

		/**
		 * Select Categories.
		 * @returns SelectControl component with category list.
		 */
		 function FrhdCategoryListBase() {

			const { useSelect } = wp.data;

			const GMcategories = useSelect( ( select ) => {
				return select( 'core' ).getEntityRecords('taxonomy', 'category');
			}, [] );
		
			if ( ! GMcategories ) {
				return null;
			}

			return (
				<SelectControl
					multiple
					label={ 'Category List:' }
					help={ 'To select multiple categories press \'CTRL\'' }
					value={ theCategories }
					options={ GMcategories.map( ( GMcategory ) => (
								{ label: GMcategory.name, value: GMcategory.id }
							))}
					onChange={ theNewCategory => setAttributes( { theCategories: theNewCategory } ) }
					className={ 'frhd__category-select-multiple' }
				/>
			);
		}

		return ([
			<InspectorControls>
				<PanelBody
					title={ __( 'Global Control' ) }
					icon={ 'admin-site-alt3' }
					initialOpen={ true }
					className={ 'frhd__global-control-gr' }>
					<Heading>Set one or multiple categories:</Heading>
					<FrhdCategoryListBase />

					<Heading>Set a Group Title:</Heading>
					<InputControl
						value={ groupTitle }
						onChange={ newValue => setAttributes( { groupTitle: newValue } ) }
						/>

					<NumberControl
						label={ __( 'Total Post Show:' ) }
						onChange={ newValue => setAttributes( { postsPerPage: newValue } ) }
						value={ postsPerPage }
						className={ 'frhd__gr-width-70' }
						/>

					<NumberControl
						label={ __( 'Post Title Word Count:' ) }
						onChange={ newValue => setAttributes( { titleWordCount: newValue } ) }
						value={ titleWordCount }
						className={ 'frhd__gr-width-70' }
						/>

					<Heading>Select a Group Image:</Heading>
					<MediaUploadCheck>
						<MediaUpload
							onSelect={ ( media ) =>
								setAttributes({ groupImageObj: media.sizes, groupImage: media.sizes.full.url })
							}
							allowedTypes={ [ 'image' ] }
							value={ groupImage }
							render={ ( { open } ) => (
								<Button
									onClick={ open }
									icon={ 'admin-media' }
									className={ 'frhd__gr-media-btn' }
									>Open Media Library</Button>
							)}
							/>
					</MediaUploadCheck>

					<SelectControl
						label={ __( 'Group Image Size:' ) }
						value={ groupImageSize }
						options={[
							{ value: null, label: 'Select a thumbnail size:', disabled: true },
							{ label: 'Thumbnail', value: 'thumbnail' },
							{ label: 'Medium', value: 'medium' },
							{ label: 'Large', value: 'large' },
							{ label: 'Full', value: 'full' },
						]}
						onChange={ newValue => setAttributes( { groupImageSize: newValue } ) }
						/>

					<ToggleControl
						label={
							isEqualHeight
								? 'Enable Custom Height.'
								: 'Disable Custom Height.'
						}
						checked={ isEqualHeight }
						onChange={ newValue => setAttributes( { isEqualHeight: newValue } ) }
						/>

					<UnitControl
						isUnitSelectTabbable
						label={ __( 'Set Height:' ) }
						value={ groupImageHeight }
						onChange={ newValue => setAttributes( { groupImageHeight: newValue } ) }
						className={ isEqualHeight ? 'frhd__gr-menu-show frhd__gr-width-70' : 'frhd__gr-menu-hide' }
						/>
				</PanelBody>
			</InspectorControls>,

			<div { ...useBlockProps() }>
				<Style>{`.frhd__block-index-${id} .frhd__post-group-image {background-image: url("${groupImage ? groupImage : 'https://via.placeholder.com/300'}");min-height: ${isEqualHeight ? groupImageHeight : '300px'};}`}</Style>
				<ServerSideRender
					block={ "category-post-view/post-group" }
					className={ 'frhd__block-index-' + id }
					/>
			</div>
		]);
	},

	// Render via PHP
    save() {
        return null;
    },

} );