import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { __experimentalHeading as Heading, PanelBody, SelectControl, __experimentalNumberControl as NumberControl, ToggleControl, __experimentalUnitControl as UnitControl, RadioControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import icons from '../../icons/icons';
import Style from 'style-it';

registerBlockType( 'trisec-post-view/post-trisec', {
	title: __( 'Post Trisec' ),
	description: __( 'Block showing a trisec of posts.' ),
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
			triPostSet,
			triCategories,
			isReversePostSetCol,
			triIsFeaturedCenter,
			isTriCustomHeight,
			triCustomHeight,
			triColGap,
			triRowGap,
			triRoundedCorner,
			triExcerptSize,
			triFeatThumbSize,
			triAsdThumbSize
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
					value={ triCategories }
					options={ GMcategories.map( ( GMcategory ) => (
								{ label: GMcategory.name, value: GMcategory.id }
							))}
					onChange={ theNewCategory => setAttributes( { triCategories: theNewCategory } ) }
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
					className={ 'frhd__global-control-gr' }
					>
					<RadioControl
						selected={ triPostSet }
						options={ [
							{ label: '1x2', value: '3' },
							{ label: '1x4', value: '5' },
						] }
						onChange={ newValue => setAttributes( { triPostSet: newValue } ) }
						className={ 'frhd__trisec-post-set' }
						/>
					<ToggleControl
						label={
							isReversePostSetCol
								? 'Enable Reverse Column.'
								: 'Disable Reverse Column.'
						}
						checked={ isReversePostSetCol }
						onChange={ newValue => setAttributes( { isReversePostSetCol: newValue } ) }
						className={ ('3' == triPostSet) ? 'frhd__gr-menu-show' : 'frhd__gr-menu-hide' }
						/>
					<ToggleControl
						label={
							triIsFeaturedCenter
								? 'Enable Featured Center.'
								: 'Disable Featured Center.'
						}
						checked={ triIsFeaturedCenter }
						onChange={ newValue => setAttributes( { triIsFeaturedCenter: newValue } ) }
						className={ ('5' == triPostSet) ? 'frhd__gr-menu-show' : 'frhd__gr-menu-hide' }
						/>

					<Heading>Set one or multiple categories:</Heading>
					<FrhdCategoryListBase />

					<ToggleControl
						label={
							isTriCustomHeight
								? 'Enable Custom Height.'
								: 'Disable Custom Height.'
						}
						checked={ isTriCustomHeight }
						onChange={ newValue => setAttributes( { isTriCustomHeight: newValue } ) }
						/>
					<UnitControl
						isUnitSelectTabbable
						label={ __( 'Set Height:' ) }
						value={ triCustomHeight }
						onChange={ newValue => setAttributes( { triCustomHeight: newValue } ) }
						className={ isTriCustomHeight ? 'frhd__gr-menu-show frhd__gr-width-70' : 'frhd__gr-menu-hide' }
						/>
					<NumberControl
						label={ __( 'Column Gap:' ) }
						value={ triColGap }
						onChange={ newValue => setAttributes( { triColGap: newValue } ) }
						className={ 'frhd__gr-width-70' }
						/>
					<NumberControl
						label={ __( 'Row Gap:' ) }
						value={ triRowGap }
						onChange={ newValue => setAttributes( { triRowGap: newValue } ) }
						className={ 'frhd__gr-width-70' }
						/>
					<NumberControl
						label={ __( 'Rounded Corner Size:' ) }
						value={ triRoundedCorner }
						onChange={ newValue => setAttributes( { triRoundedCorner: newValue } ) }
						className={ 'frhd__gr-width-70' }
						/>
					<NumberControl
						label={ __( 'Excerpt Word Count:' ) }
						value={ triExcerptSize }
						onChange={ newValue => setAttributes( { triExcerptSize: newValue } ) }
						className={ 'frhd__gr-width-70' }
						/>
					<SelectControl
						label={ __( 'Featured Thumbnail Size:' ) }
						value={ triFeatThumbSize }
						options={[
							{ value: null, label: 'Select a thumbnail size:', disabled: true },
							{ label: 'Thumbnail', value: 'thumbnail' },
							{ label: 'Medium', value: 'medium' },
							{ label: 'Medium Large', value: 'medium_large' },
							{ label: 'Large', value: 'large' },
							{ label: 'Full', value: 'full' },
						]}
						onChange={ newValue => setAttributes( { triFeatThumbSize: newValue } ) }
					/>
					<SelectControl
						label={ __( 'Aside Thumbnail Size:' ) }
						value={ triAsdThumbSize }
						options={[
							{ value: null, label: 'Select a thumbnail size:', disabled: true },
							{ label: 'Thumbnail', value: 'thumbnail' },
							{ label: 'Medium', value: 'medium' },
							{ label: 'Medium Large', value: 'medium_large' },
							{ label: 'Large', value: 'large' },
							{ label: 'Full', value: 'full' },
						]}
						onChange={ newValue => setAttributes( { triAsdThumbSize: newValue } ) }
					/>
				</PanelBody>
			</InspectorControls>,

			<div { ...useBlockProps() }>
				<Style>{`.frhd__block-index-${id} .frhd__trisec-wrapper{flex-direction:${isReversePostSetCol ? 'row-reverse' : 'row'}!important;};`}</Style>
				<ServerSideRender
					block={ "trisec-post-view/post-trisec" }
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