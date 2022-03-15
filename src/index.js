import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { InspectorControls, ColorPalette, useBlockProps } from '@wordpress/block-editor';
import { __experimentalHeading as Heading, __experimentalNumberControl as NumberControl, PanelBody, SelectControl, ToggleControl, RadioControl, __experimentalUnitControl as UnitControl, __experimentalInputControl as InputControl, Button, Dropdown } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import { useState } from '@wordpress/element';
import icons from '../icons/icons';
import Style from 'style-it';

import './block-post-cat';

registerBlockType( 'gutenberg-post-view/post-block', {
	title: __( 'Post Block' ),
	description: __( 'Block showing post grid.' ),
	icon: icons.postlayoutsicn,
	category: 'text',
	keywords: [ __( 'latest' ), __( 'posts' ), __( 'grid' ) ],
	attributes: {
		id: {
            type: 'string'
        },
		postLayout: {
			type: 'string',
			default: 'grid1'
		},
		maxWidth: {
			type: 'string',
			default: '1140'
		},
		postCol: {
			type: 'string',
			default: '3'
		},
		postBodyColor: {
			type: 'string',
			default: '#f5f5f5'
		},
		taxonomyColor: {
			type: 'string',
			default: '#000000'
		},
		taxonomyBGcolor: {
			type: 'string',
			default: '#ffc107'
		},
		taxonomyPrecolor: {
			type: 'string',
			default: '#497898'
		},
		postTitleColor: {
			type: 'string',
			default: '#371f0e'
		},
		postMetaColor: {
			type: 'string',
			default: '#424242'
		},
		postDateBGColor: {
			type: 'string',
			default: '#ffc107'
		},
		postMetaIconColor: {
			type: 'string',
			default: '#424242'
		},
		postDescColor: {
			type: 'string',
			default: '#4b4f58'
		},
		postAuthorColor: {
			type: 'string',
			default: '#497898'
		},
		postBtnTextColor: {
			type: 'string',
			default: '#ffffff'
		},
		postBtnColor: {
			type: 'string',
			default: '#d32f2f'
		},
		hoverBtnTextColor: {
			type: 'string',
			default: '#ffffff'
		},
		hoverBtnColor: {
			type: 'string',
			default: '#ef5350'
		},
		readingTimeColor: {
			type: 'string',
			default: '#ef5350'
		},
		readingTimeIconColor: {
			type: 'string',
			default: '#d32f2f'
		},
		paginationNumColor: {
			type: 'string',
			default: '#ffffff'
		},
		paginationBGColor: {
			type: 'string',
			default: '#d32f2f'
		},
		pagiActiveNumColor: {
			type: 'string',
			default: '#ffffff'
		},
		pagiActiveBGColor: {
			type: 'string',
			default: '#c1c1c1'
		},
		paginationAlign: {
			type: "string",
			default: 'left'
		},
		postsPerPage: {
			type: 'string',
			default: '6'
		},
		theCategories: {
			type: 'array',
			default: null
		},
		postQuery: {
			type: 'string',
			default: null
		},
		postOrder: {
			type: 'string',
			default: 'DESC'
		},
		colGap: {
			type: 'string',
			default: '15'
		},
		rowGap: {
			type: 'string',
			default: '15'
		},
		roundedCornerSize: {
			type: 'string',
			default: '5'
		},
		excerptWordCount: {
			type: 'string',
			default: '19'
		},
		postThumbSize: {
			type: 'string',
			default: 'medium'
		},
		hasPostThumb: {
			type: 'boolean',
			default: 'true'
		},
		hasPostTitle: {
			type: 'boolean',
			default: 'true'
		},
		hasPostAuthor: {
			type: 'boolean',
			default: 'true'
		},
		hasPostDate: {
			type: 'boolean',
			default: 'true'
		},
		hasPostComment: {
			type: 'boolean'
		},
		hasPostTaxonomy: {
			type: 'boolean',
			default: 'true'
		},
		hasPostExcerpt: {
			type: 'boolean',
			default: 'true'
		},
		hasPostbtn: {
			type: 'boolean',
			default: 'true'
		},
		hasReadTime: {
			type: 'boolean',
			default: 'true'
		},
		hasPostPagin: {
			type: 'boolean',
			default: 'true'
		},
		hasViewCount: {
			type: 'boolean',
			default: 'true'
		},
		hasLoveReact: {
			type: 'boolean'
		},
		titleFontSize: {
			type: 'string',
			default: '22px'
		},
		metaFontSize: {
			type: 'string',
			default: '16px'
		},
		metaIconSize: {
			type: 'string',
			default: '15px'
		},
		descFontSize: {
			type: 'string',
			default: '19px'
		},
		buttonFontSize: {
			type: 'string',
			default: '16px'
		},
		catFontSize: {
			type: 'string',
			default: '20px'
		},
		authFontSize: {
			type: 'string',
			default: '20px'
		},
		bodyContentColor: {
			type: 'string',
			default: '#ffffff'
		},
		readMoreBtnText: {
			type: 'string',
			default: 'Read More!'
		},
		hasEqualHeight: {
			type: 'boolean'
		},
		equalHeightSize: {
			type: 'string',
			default: '200px'
		},
	},

	edit({ clientId, attributes, setAttributes }) {

		const {
			id,
			postLayout,
			maxWidth,
			postCol,
			postBodyColor,
			postTitleColor,
			postMetaColor,
			postDateBGColor,
			postMetaIconColor,
			postDescColor,
			postAuthorColor,
			postBtnTextColor,
			postBtnColor,
			hoverBtnTextColor,
			hoverBtnColor,
			readingTimeColor,
			readingTimeIconColor,
			paginationNumColor,
			paginationBGColor,
			pagiActiveNumColor,
			pagiActiveBGColor,
			paginationAlign,
			postsPerPage,
			theCategories,
			postQuery,
			postOrder,
			colGap,
			rowGap,
			roundedCornerSize,
			excerptWordCount,
			postThumbSize,
			hasPostThumb,
			hasPostTitle,
			hasPostAuthor,
			hasPostDate,
			hasPostComment,
			hasPostTaxonomy,
			hasPostExcerpt,
			hasPostbtn,
			hasReadTime,
			hasPostPagin,
			hasViewCount,
			hasLoveReact,
			taxonomyColor,
			taxonomyBGcolor,
			taxonomyPrecolor,
			titleFontSize,
			metaFontSize,
			metaIconSize,
			descFontSize,
			buttonFontSize,
			catFontSize,
			authFontSize,
			bodyContentColor,
			readMoreBtnText,
			hasEqualHeight,
			equalHeightSize
		} = attributes;

		/**
		 * Set unique ID through block index.
		 */
		// let blockIndex = wp.data.select( 'core/block-editor' ).getBlockIndex( clientId );
		// setAttributes({ id: blockIndex });
		setAttributes({ id: clientId }); // The Block ID.

		/**
		 * Set attributes of components.
		 */
		function onLayoutChange( newLayout ) {

			setAttributes({ postLayout: newLayout });
		}
		function onMaxWidthChange( newWidth ) {

			setAttributes({ maxWidth: newWidth });
		}
		function onPostColChange( newPostCol ) {

			setAttributes({ postCol: newPostCol });
		}
		function onPostsPerPageChange( newOpacity ) {

			setAttributes({ postsPerPage: newOpacity });
		}
		function onPostQueryChange( newPostQuery ) {

			setAttributes({ postQuery: newPostQuery });
		}
		function onPostOrderChange( newPostOrder ) {

			setAttributes({ postOrder: newPostOrder });
		}
		function onColGapChange( newColGap ) {

			setAttributes({ colGap: newColGap });
		}
		function onRowGapChange( newRowGap ) {

			setAttributes({ rowGap: newRowGap });
		}
		function onRoundSizeChange( newRoundSize ) {

			setAttributes({ roundedCornerSize: newRoundSize });
		}
		function onExcerptWordCountChange( newWordCount ) {

			setAttributes({ excerptWordCount: newWordCount });
		}
		function onPostThumbSizeChange( newThumbSize ) {

			setAttributes({ postThumbSize: newThumbSize });
		}
		function onPaginationAlignChange( newPagiAlign ) {

			setAttributes({ paginationAlign: newPagiAlign });
		}
		function onTitleFontSizeChange( newtitleFontSize ) {

			setAttributes({ titleFontSize: newtitleFontSize });
		}
		function onMetaFontSizeChange( newMetaFontSize ) {

			setAttributes({ metaFontSize: newMetaFontSize });
		}
		function onMetaIconSizeChange( newMetaIconSize ) {

			setAttributes({ metaIconSize: newMetaIconSize });
		}
		function onDescFontSizeChange( newDescFontSize ) {

			setAttributes({ descFontSize: newDescFontSize });
		}
		function onBtnFontSizeChange( newBtnFontSize ) {

			setAttributes({ buttonFontSize: newBtnFontSize });
		}
		function onCatFontSizeChange( newCatFontSize ) {

			setAttributes({ catFontSize: newCatFontSize });
		}
		function onAuthFontSizeChange( newAuthFontSize ) {

			setAttributes({ authFontSize: newAuthFontSize });
		}
		function onReadMoreBtnTxtChange( newReadMoreBtnTxt ) {

			setAttributes({ readMoreBtnText: newReadMoreBtnTxt });
		}
		function onEqualSizeChange( newEqualSize ) {

			setAttributes({ equalHeightSize: newEqualSize });
		}

		/**
		 * Set Attributes of Togglecontrol Components.
		 */
		const setPostThumb = () => setAttributes( { hasPostThumb: ! hasPostThumb } );
		const setPostTitle = () => setAttributes( { hasPostTitle: ! hasPostTitle } );
		const setPostAuthor = () => setAttributes( { hasPostAuthor: ! hasPostAuthor } );
		const setPostDate = () => setAttributes( { hasPostDate: ! hasPostDate } );
		const setPostComment = () => setAttributes( { hasPostComment: ! hasPostComment } );
		const setPostTaxonomy = () => setAttributes( { hasPostTaxonomy: ! hasPostTaxonomy } );
		const setPostExcerpt = () => setAttributes( { hasPostExcerpt: ! hasPostExcerpt } );
		const setPostbtn = () => setAttributes( { hasPostbtn: ! hasPostbtn } );
		const setReadTime = () => setAttributes( { hasReadTime: ! hasReadTime } );
		const setPostPagin = () => setAttributes( { hasPostPagin: ! hasPostPagin } );
		const setViewCount = () => setAttributes( { hasViewCount: ! hasViewCount } );
		const setLoveReact = () => setAttributes( { hasLoveReact: ! hasLoveReact } );
		const setEqualHeight = () => setAttributes( { hasEqualHeight: ! hasEqualHeight } );

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

		/**
		 * Post Title Typography.
		 * @returns Typography fields..
		 */
		const FrhdPostTitleTypo = () => (
			<Dropdown
				className='frhd__typo-btn'
				contentClassName='frhd__popover-content'
				position='bottom right'
				renderToggle={ ( { isOpen, onToggle } ) => (

					<Button
						variant='secondary'
						onClick={ onToggle }
						aria-expanded={ isOpen }
					>
						Post Title Typography
					</Button>
				) }
				renderContent={ () => <div>

					<UnitControl
						label={ __( 'Set Font Size:' ) }
						onChange={ (e) => console.log(e) }
						value={ '18' }
						className='frhd__typo-field'
						/>

					<SelectControl
						label={ __( 'Select Font Weight:' ) }
						value={ 'bold' }
						onChange={ (e) => console.log(e) }
						options={ [
							{ value: null, label: 'Select a weight', disabled: true },
							{ value: 'normal', label: 'normal' },
							{ value: 'bold', label: 'bold' },
							{ value: 'bolder', label: 'bolder' },
							{ value: 'lighter', label: 'lighter' },
							{ value: 'initial', label: 'initial' },
							{ value: 'inherit', label: 'inherit' },
						] }
						className='frhd__typo-field'
						/>

					<UnitControl
						label={ __( 'Set Line Height:' ) }
						onChange={ (e) => console.log(e) }
						value={ '18' }
						className='frhd__typo-field'
						/>

					<UnitControl
						label={ __( 'Set Letter Spacing:' ) }
						onChange={ (e) => console.log(e) }
						value={ '18' }
						className='frhd__typo-field'
						/>

					<SelectControl
						label={ __( 'Set Text Transform:' ) }
						value={ 'capitalize' }
						onChange={ (e) => console.log(e) }
						options={ [
							{ value: null, label: 'Select a weight', disabled: true },
							{ value: 'none', label: 'none' },
							{ value: 'capitalize', label: 'capitalize' },
							{ value: 'uppercase', label: 'uppercase' },
							{ value: 'lowercase', label: 'lowercase' },
							{ value: 'initial', label: 'initial' },
							{ value: 'inherit', label: 'inherit' },
						] }
						className='frhd__typo-field'
						/>
				</div> }
			/>
		);

		return ([
			<InspectorControls>
				<PanelBody
					title={ __( 'Global Control' ) }
					icon={ 'admin-site-alt3' }
					initialOpen={ true }
					className={ 'frhd__global-control' }
					>
					<SelectControl
						label={ __( 'Post Layout:' ) }
						help={ 'Post Layout mainly show the view of a post.' }
						value={ postLayout }
						options={[
							{ value: null, label: 'Select a post layout', disabled: true },
							{ label: 'Grid 1', value: 'grid1' },
							{ label: 'Grid 2', value: 'grid2' },
							{ label: 'Grid 3', value: 'grid3' },
							{ label: 'Grid 4', value: 'grid4' },
							{ label: 'Grid 5', value: 'grid5' },
						]}
						onChange={ onLayoutChange }
					/>
					<UnitControl
						label={ __( 'Set maximum width of this block:' ) }
						onChange={ onMaxWidthChange }
						isUnitSelectTabbable
						value={ maxWidth }
						/>
					<NumberControl
						label={ __( 'Set column of the posts:' ) }
						onChange={ onPostColChange }
						value={ postCol }
					/>
					<NumberControl
						label={ __( 'Total Post Count:' ) }
						onChange={ onPostsPerPageChange }
						value={ postsPerPage }
					/>
					<NumberControl
						label={ __( 'Column Gap:' ) }
						onChange={ onColGapChange }
						value={ colGap }
						className={ 'frhd__number-control-px' }
					/>
					<NumberControl
						label={ __( 'Row Gap:' ) }
						onChange={ onRowGapChange }
						value={ rowGap }
						className={ 'frhd__number-control-px' }
					/>
					<NumberControl
						label={ __( 'Rounded Corner Size:' ) }
						onChange={ onRoundSizeChange }
						value={ roundedCornerSize }
						className={ 'frhd__number-control-px' }
					/>
					<NumberControl
						label={ __( 'Excerpt Word Count:' ) }
						onChange={ onExcerptWordCountChange }
						value={ excerptWordCount }
					/>
				</PanelBody>

				<PanelBody
					title={ 'Query' }
					icon={ 'filter' }
					initialOpen={ false }
					className={ 'frhd__query-control' }
					>
					<Heading
						className={ 'frhd__pb-heading' }
						>Set one or multiple categories.</Heading>
					<FrhdCategoryListBase />
					<SelectControl
						label={ __( 'Post Query:' ) }
						help={ 'The popular post - popularity count from now! You activate the plugin.' }
						value={ postQuery }
						options={[
							{ value: null, label: 'Select a post query:', disabled: true },
							{ label: 'Random Posts', value: 'random' },
							{ label: 'Most Popular', value: 'popular' },
						]}
						onChange={ onPostQueryChange }
					/>
					<SelectControl
						label={ __( 'Post Order:' ) }
						help={ 'Designates the ascending or descending order of the post query.' }
						value={ postOrder }
						options={[
							{ value: null, label: 'Select a post order:', disabled: true },
							{ label: 'Ascending', value: 'ASC' },
							{ label: 'Descending', value: 'DESC' },
						]}
						onChange={ onPostOrderChange }
					/>
					<SelectControl
						label={ __( 'Thumbnail Size:' ) }
						value={ postThumbSize }
						options={[
							{ value: null, label: 'Select a thumbnail size:', disabled: true },
							{ label: 'Thumbnail', value: 'thumbnail' },
							{ label: 'Medium', value: 'medium' },
							{ label: 'Medium Large', value: 'medium_large' },
							{ label: 'Large', value: 'large' },
							{ label: 'Full', value: 'full' },
						]}
						onChange={ onPostThumbSizeChange }
					/>
					<ToggleControl
						label={
							hasEqualHeight
								? 'Enable Equal Size.'
								: 'Disable Equal Size.'
						}
						checked={ hasEqualHeight }
						onChange={ setEqualHeight }
						className={ ('grid4' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
						/>
					<UnitControl
						label={ __( 'Set a maximum height of feature images:' ) }
						onChange={ onEqualSizeChange }
						isUnitSelectTabbable
						value={ equalHeightSize }
						className={ hasEqualHeight ? 'frhd__menu-show frhd__pb-unitcontrol' : 'frhd__menu-hide' }
						/>
					<Heading
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__pb-heading frhd__pb-heading' }
						>Set a Read More Text:</Heading>
					<InputControl
						value={ readMoreBtnText }
						onChange={ onReadMoreBtnTxtChange }
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
						/>
				</PanelBody>

				<PanelBody
					title={ 'Content Visibility' }
					icon={ 'format-aside' }
					initialOpen={ false }
					className={ 'frhd__content-visibility' }>
					<ToggleControl
						label={
							hasPostThumb
								? 'Show Post Thumbnails.'
								: 'Hide Post Thumbnails.'
						}
						checked={ hasPostThumb }
						onChange={ setPostThumb }
					/>
					<ToggleControl
						label={
							hasPostTitle
								? 'Show Post Title.'
								: 'Hide Post Title.'
						}
						checked={ hasPostTitle }
						onChange={ setPostTitle }
					/>
					<ToggleControl
						label={
							hasPostAuthor
								? 'Show Post Author.'
								: 'Hide Post Author.'
						}
						checked={ hasPostAuthor }
						onChange={ setPostAuthor }
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
					/>
					<ToggleControl
						label={
							hasPostDate
								? 'Show Post Date.'
								: 'Hide Post Date.'
						}
						checked={ hasPostDate }
						onChange={ setPostDate }
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
					/>
					<ToggleControl
						label={
							hasPostComment
								? 'Show Post Comment.'
								: 'Hide Post Comment.'
						}
						checked={ hasPostComment }
						onChange={ setPostComment }
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
					/>
					<ToggleControl
						label={
							hasViewCount
								? 'Show View Count.'
								: 'Hide View Count.'
						}
						checked={ hasViewCount }
						onChange={ setViewCount }
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
					/>
					<ToggleControl
						label={
							hasPostTaxonomy
								? 'Show Post Taxonomy.'
								: 'Hide Post Taxonomy.'
						}
						checked={ hasPostTaxonomy }
						onChange={ setPostTaxonomy }
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
					/>
					<ToggleControl
						label={
							hasPostExcerpt
								? 'Show Post Excerpt.'
								: 'Hide Post Excerpt.'
						}
						checked={ hasPostExcerpt }
						onChange={ setPostExcerpt }
					/>
					<ToggleControl
						label={
							hasPostbtn
								? 'Show Post Button.'
								: 'Hide Post Button.'
						}
						checked={ hasPostbtn }
						onChange={ setPostbtn }
					/>
					<ToggleControl
						label={
							hasReadTime
								? 'Show Reading Time.'
								: 'Hide Reading Time.'
						}
						checked={ hasReadTime }
						onChange={ setReadTime }
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
					/>
					<ToggleControl
						label={
							hasPostPagin
								? 'Show Pagination.'
								: 'Hide Pagination.'
						}
						checked={ hasPostPagin }
						onChange={ setPostPagin }
					/>
					<ToggleControl
						label={
							hasLoveReact
								? 'Show Love React.'
								: 'Hide Love React.'
						}
						help={
							hasLoveReact
								? 'Go to Dashboard Settings > Post Block Options > Check Heart React and Save Changes.'
								: ''
						}			
						checked={ hasLoveReact }
						onChange={ setLoveReact }
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
					/>
				</PanelBody>

				<PanelBody
					title={ 'Color Settings' }
					icon="admin-appearance"
					initialOpen={ false }
					className={ 'frhd__color-picker' }>
					<strong>{ __( "Posts Body Background Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: postBodyColor }} ></span></strong>
					<ColorPalette
						value={ postBodyColor }
						onChange={ ( colorValue ) => setAttributes( { postBodyColor: colorValue } )}
						/>

					<strong className={ 'grid4' == postLayout ? 'frhd__menu-show' : 'frhd__menu-hide' }>{ __( "Posts Body Content Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: bodyContentColor }} ></span></strong>
					<ColorPalette
						value={ bodyContentColor }
						onChange={ ( colorValue ) => setAttributes( { bodyContentColor: colorValue } )}
						className={ 'grid4' == postLayout ? 'frhd__menu-show' : 'frhd__menu-hide' }
						/>

					<strong>{ __( "Post Title Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: postTitleColor }} ></span></strong>
					<ColorPalette
						value={ postTitleColor }
						onChange={ ( colorValue ) => setAttributes( { postTitleColor: colorValue } )}
						/>
					
					<strong
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }>{ __( "Posts Taxonomy Color: " ) }<span className={ 'component-color-indicator' } style={{ backgroundColor: taxonomyColor }} ></span></strong>
					<ColorPalette
						value={ taxonomyColor }
						onChange={ ( colorValue ) => setAttributes( { taxonomyColor: colorValue } )}
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
						/>

					<strong
						className={ ('grid2' == postLayout || 'grid4' == postLayout || 'grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }>{ __( "Taxonomy Background Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: taxonomyBGcolor }} ></span></strong>
					<ColorPalette
						value={ taxonomyBGcolor }
						onChange={ ( colorValue ) => setAttributes( { taxonomyBGcolor: colorValue } )}
						className={ ( 'grid2' == postLayout || 'grid4' == postLayout || 'grid5' == postLayout ) ? 'frhd__menu-hide' : 'frhd__menu-show' }
						/>

					<strong className={ 'grid2' == postLayout ? 'frhd__menu-show' : 'frhd__menu-hide' }>{ __( "Taxonomy Prefix Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: taxonomyPrecolor }} ></span></strong>
					<ColorPalette
						value={ taxonomyPrecolor }
						onChange={ ( colorValue ) => setAttributes( { taxonomyPrecolor: colorValue } )}
						className={ 'grid2' == postLayout ? 'frhd__menu-show' : 'frhd__menu-hide' }
						/>

					<strong className={ 'grid2' == postLayout ? 'frhd__menu-show' : 'frhd__menu-hide' }>{ __( "Author Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: postAuthorColor }} ></span></strong>
					<ColorPalette
						value={ postAuthorColor }
						onChange={ ( colorValue ) => setAttributes( { postAuthorColor: colorValue } )}
						className={ 'grid2' == postLayout ? 'frhd__menu-show' : 'frhd__menu-hide' }
						/>
						
					<strong
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }>{ __( "Posts Meta Color: " ) }<span className={ 'component-color-indicator' } style={{ backgroundColor: postMetaColor }} ></span></strong>
					<ColorPalette
						value={ postMetaColor }
						onChange={ ( colorValue ) => setAttributes( { postMetaColor: colorValue } )}
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
						/>

					<strong className={ 'grid2' == postLayout ? 'frhd__menu-show' : 'frhd__menu-hide' }>{ __( "Date Background Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: postDateBGColor }} ></span></strong>
					<ColorPalette
						value={ postDateBGColor }
						onChange={ ( colorValue ) => setAttributes( { postDateBGColor: colorValue } )}
						className={ 'grid2' == postLayout ? 'frhd__menu-show' : 'frhd__menu-hide' }
						/>
						
					<strong
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }>{ __( "Posts Meta Icon Color: " ) }<span className={ 'component-color-indicator' } style={{ backgroundColor: postMetaIconColor }} ></span></strong>
					<ColorPalette
						value={ postMetaIconColor }
						onChange={ ( colorValue ) => setAttributes( { postMetaIconColor: colorValue } )}
						className={ ('grid5' == postLayout) ? 'frhd__menu-hide' : 'frhd__menu-show' }
						/>

					<strong>{ __( "Posts Description Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: postDescColor}} ></span></strong>
					<ColorPalette
						value={ postDescColor }
						onChange={ ( colorValue ) => setAttributes( { postDescColor: colorValue } )}
						/>
							
					<strong>{ __( "Posts Button Text Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: postBtnTextColor }} ></span></strong>
					<ColorPalette
						value={ postBtnTextColor }
						onChange={ ( colorValue ) => setAttributes( { postBtnTextColor: colorValue } )}
						/>
							
					<strong>{ __( "Posts Button Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: postBtnColor }} ></span></strong>
					<ColorPalette
						value={ postBtnColor }
						onChange={ ( colorValue ) => setAttributes( { postBtnColor: colorValue } )}
						/>
							
					<strong>{ __( "Button Hover Text Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: hoverBtnTextColor }} ></span></strong>
					<ColorPalette
						value={ hoverBtnTextColor }
						onChange={ ( colorValue ) => setAttributes( { hoverBtnTextColor: colorValue } )}
						/>
							
					<strong>{ __( "Button Hover Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: hoverBtnColor }} ></span></strong>
					<ColorPalette
						value={ hoverBtnColor }
						onChange={ ( colorValue ) => setAttributes( { hoverBtnColor: colorValue } )}
						/>
							
					<strong className={ 'grid2' == postLayout ? 'frhd__menu-hide' : 'frhd__menu-hide' }>{ __( "Posts Reading Time Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: readingTimeColor }} ></span></strong>
					<ColorPalette
						value={ readingTimeColor }
						onChange={ ( colorValue ) => setAttributes( { readingTimeColor: colorValue } )}
						className={ 'grid2' == postLayout ? 'frhd__menu-hide' : 'frhd__menu-hide' }
						/>
							
					<strong className={ 'grid2' == postLayout ? 'frhd__menu-hide' : 'frhd__menu-hide' }>{ __( "Reading Time Icon Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: readingTimeIconColor }} ></span></strong>
					<ColorPalette
						value={ readingTimeIconColor }
						onChange={ ( colorValue ) => setAttributes( { readingTimeIconColor: colorValue } )}
						className={ 'grid2' == postLayout ? 'frhd__menu-hide' : 'frhd__menu-hide' }
						/>
								
					<strong>{ __( "Pagination Number Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: paginationNumColor}} ></span></strong>
					<ColorPalette
						value={ paginationNumColor }
						onChange={ ( colorValue ) => setAttributes( { paginationNumColor: colorValue } )}
						/>
								
					<strong>{ __( "Pagination Background Color: " ) }<span className="component-color-indicator" style={{ backgroundColor: paginationBGColor }} ></span></strong>
					<ColorPalette
						value={ paginationBGColor }
						onChange={ ( colorValue ) => setAttributes( { paginationBGColor: colorValue } )}
						/>
								
					<strong>{ __( "Pagination Active Number: " ) }<span className="component-color-indicator" style={{ backgroundColor: pagiActiveNumColor }} ></span></strong>
					<ColorPalette
						value={ pagiActiveNumColor }
						onChange={ ( colorValue ) => setAttributes( { pagiActiveNumColor: colorValue } )}
						/>
								
					<strong>{ __( "Pagination Active Background: " ) }<span className="component-color-indicator" style={{ backgroundColor: pagiActiveBGColor }} ></span></strong>
					<ColorPalette
						value={ pagiActiveBGColor }
						onChange={ ( colorValue ) => setAttributes( { pagiActiveBGColor: colorValue } )}
						/>
				</PanelBody>

				<PanelBody
					title={ 'Alignment' }
					icon={ 'leftright' }
					initialOpen={ false }
					className={ 'frhd__alignment-options' }>
					
					<RadioControl
						label={ 'Pagination Alignment' }
						selected={ paginationAlign }
						options={ [
							{ label: 'Left', value: 'left' },
							{ label: 'Center', value: 'center' },
							{ label: 'Right', value: 'right' },
						] }
						onChange={ onPaginationAlignChange }
						/>
				</PanelBody>

				<PanelBody
					title={ 'Typography' }
					icon={ 'editor-textcolor' }
					initialOpen={ false }
					className={ 'frhd__typography-options' }>

					<Heading>Click the button to show a set of typography fields 👇</Heading>

					<FrhdPostTitleTypo />

					<UnitControl
						onChange={ onTitleFontSizeChange }
						label={ __( 'Post Title Font Size:' ) }
						isUnitSelectTabbable
						value={ titleFontSize }
						/>

					<UnitControl
						onChange={ onMetaFontSizeChange }
						label={ __( 'Meta Font Size:' ) }
						isUnitSelectTabbable
						value={ metaFontSize }
						/>
					
					<UnitControl
						onChange={ onMetaIconSizeChange }
						label={ __( 'Meta Icon Size:' ) }
						isUnitSelectTabbable
						value={ metaIconSize }
						/>

					<UnitControl
						onChange={ onDescFontSizeChange }
						label={ __( 'Description Font Size:' ) }
						isUnitSelectTabbable
						value={ descFontSize }
						/>

					<UnitControl
						onChange={ onBtnFontSizeChange }
						label={ __( 'Button Font Size:' ) }
						isUnitSelectTabbable
						value={ buttonFontSize }
						/>

					<UnitControl
						onChange={ onCatFontSizeChange }
						label={ __( 'Category Font Size:' ) }
						isUnitSelectTabbable
						value={ catFontSize }
						className={ 'grid2' == postLayout ? 'frhd__menu-show' : 'frhd__menu-hide' }
						/>

					<UnitControl
						onChange={ onAuthFontSizeChange }
						label={ __( 'Author Font Size:' ) }
						isUnitSelectTabbable
						value={ authFontSize }
						className={ 'grid2' == postLayout ? 'frhd__menu-show' : 'frhd__menu-hide' }
						/>
				</PanelBody>
			</InspectorControls>,

			<div { ...useBlockProps() }>
				<Style>{`.frhd__block-index-${id} .frhd__post-block-wrapper{max-width: ${maxWidth} !important;}.frhd__block-index-${id} .frhd__post-block-article{flex-basis: calc(100% / ${postCol} - ${colGap}px) !important;background-color: ${postBodyColor} !important;border-radius: ${roundedCornerSize}px;}.frhd__block-index-${id} .frhd__featured-image img{border-top-left-radius: ${roundedCornerSize}px;border-top-right-radius: ${roundedCornerSize}px;}.frhd__block-index-${id} .frhd__post-block-container{column-gap: ${colGap}px;row-gap: ${rowGap}px !important;}.frhd__block-index-${id} .frhd__featured-image img{display: ${hasPostThumb ? 'block' : 'none'}}.frhd__block-index-${id} .frhd__post-title{display: ${hasPostTitle ? 'block' : 'none'}}.frhd__block-index-${id} .frhd__post-title a {font-size: ${titleFontSize} !important;color: ${postTitleColor} !important;}.frhd__block-index-${id} .frhd__post-meta, .frhd__block-index-${id} .frhd__post-meta a {font-size: ${metaFontSize};color: ${postMetaColor} !important;}.frhd__block-index-${id} .frhd__post-meta svg {height: ${metaIconSize};width: ${metaIconSize};fill: ${postMetaIconColor} !important;}.frhd__block-index-${id} .frhd__post-author{display: ${hasPostAuthor ? 'block' : 'none'}}.frhd__block-index-${id} .frhd__post-date{display: ${hasPostDate ? 'block' : 'none'}}.frhd__block-index-${id} .frhd__post-view{display: ${hasViewCount ? 'block' : 'none'}}.frhd__block-index-${id} .frhd__cat-wrap{display: ${hasPostTaxonomy ? 'block' : 'none'}}.frhd__block-index-${id} .frhd__cat-name a {color: ${taxonomyColor} !important;background-color: ${taxonomyBGcolor} !important;}.frhd__block-index-${id} .frhd__post-excerpt{display: ${hasPostExcerpt ? 'block' : 'none'}}.frhd__block-index-${id} .frhd__post-excerpt p {font-size: ${descFontSize};color: ${postDescColor} !important;}.frhd__block-index-${id} .frhd__post-btn a{display: ${hasPostbtn ? 'inline-block' : 'none'}}.frhd__block-index-${id} .frhd__post-btn a{font-size: ${buttonFontSize};color: ${postBtnTextColor} !important;background: ${postBtnColor} !important;}.frhd__block-index-${id} .frhd__post-btn a:hover {color: ${hoverBtnTextColor} !important;background: ${hoverBtnColor} !important;}.frhd__block-index-${id} .frhd__reading-time {display: ${hasReadTime ? 'inline-flex' : 'none'};color: ${readingTimeColor} !important;}.frhd__block-index-${id} .frhd__reading-time svg {fill: ${readingTimeIconColor} !important;}.frhd__block-index-${id} .frhd__paginate{display: ${hasPostPagin ? 'block' : 'none'}}.frhd__block-index-${id} .frhd__paginate .page-numbers {color: ${paginationNumColor} !important;background: ${paginationBGColor} !important;}.frhd__block-index-${id} .frhd__paginate .page-numbers.current {color: ${pagiActiveNumColor} !important;background: ${pagiActiveBGColor} !important;}`}</Style>
            	<ServerSideRender
                	block={ "gutenberg-post-view/post-block" }
					className={ 'frhd__block-index-' + id } />
			</div>
		]);
	},

	// Render via PHP
    save() {
        return null;
    },

} );