<?php
/**
 * CRMN_Member_Search_Module "frontend HTML" file.
 *
 * Used by Beaver Builder to generate the markup output.
 * The following variables are made available as globals in this template partial by Beaver Builder...
 *
 * @var \CRMN_Member_Search_Module $module   An instance of the module class.
 * @var string                     $id       The module's node ID ( i.e. $module->node ).
 * @var stdClass                   $settings The module's settings ( i.e. $module->settings ).
 * @see \CRMN_Member_Search_Module
 * @see \FLBuilderModule
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * If the form was submitted, get the search query vars from $_POST for setting form state.
 */
if ( $module::is_member_search() ) {

	/**
	 * The search query could look something like the following...
	 * Array (
	 *     'first_name'                  => 'Richard'
	 *     'last_name'                   => 'Aber'
	 *     'company'                     => 'Nerdery'
	 *     'services_provided'           => 'mediation'
	 *     'detailed_adr_matters'        => 'training'
	 *     'additional_languages_spoken' => 'chinese'
	 *     'search-center'               => '55431'
	 *     'search-radius'               => '5'
	 *     'crm-member-search'           => 'e88cef0fa3'
	 *     '_wp_http_referer'            => '/'
	 *     'submit-directory-search'     => 'Directory Search'
	 * )
	 *
	 * @var array $directory_search_user_query
	 */
	$module->directory_search_user_query = $module->get_directory_search_user_query();

	/**
	 * Get our search center.
	 */
	if ( ! empty( $module->directory_search_user_query ) ) {
		$geocoder = new CRMN_Member_Search_Geocoder();
		$module->search_center = $geocoder->geocode_address( $module->directory_search_user_query['search-center'] );
	}

	/**
	 * Run the search.
	 */
	if ( ! empty( $module->search_center ) ) {

		/**
		 * Set the extra query vars.
		 */
		$module->set_extra_query();

		$search_results = $module::get_geodata_radius_search(
			$module->search_center['geo_latitude'],
			$module->search_center['geo_longitude'],
			$module->directory_search_user_query['search-radius'],
			'mi',
			$module->get_extra_query()
		);
	}
}

?>

<?php if ( $module::is_member_search() ) : ?>

	<?php if ( ! empty( $search_results ) ) : ?>
		<h3>
			<?php
			printf(
				/* translators: placeholder is a digit representing the number of search results found */
				esc_html__( '%d members found.', 'crm-member-search' ),
				count( $search_results )
			);
			?>
		</h3>
	<?php endif; ?>

	<?php if ( empty( $search_results ) ) : ?>
		<h3>
			<?php esc_html_e( 'No members found.', 'crm-member-search' ); ?>
		</h3>

		<h4>
			<em>
				<?php esc_html_e( 'Try another search.', 'crm-member-search' ); ?>
			</em>
		</h4>
	<?php endif; ?>

<?php endif; ?>

<div id="<?php echo esc_attr( $id ); ?>" class="crmn-directory-wrapper">

	<form role="search"
		  class="form-horizontal"
		  action=""
		  accept-charset="UTF-8"
		  method="post"
		  id="crm-directory-search-<?php echo esc_attr( $id ); ?>">

		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="first_name">
					<?php echo esc_html_x( 'First Name', 'label', 'crmn-member-search' ); ?>
				</label>
				<input type="text"
					   maxlength="256"
					   name="first_name"
					   id="first_name"
					   class="form-control"
					   value="">
			</div>
			<div class="col-sm-6 form-group">
				<label for="last_name">
					<?php echo esc_html_x( 'Last Name', 'label', 'crmn-member-search' ); ?>
				</label>
				<input type="text"
					   maxlength="256"
					   name="last_name"
					   id="last_name"
					   size="30"
					   class="form-control"
					   value="">
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="company">
					<?php echo esc_html_x( 'Company', 'label', 'crmn-member-search' ); ?>
				</label>
				<input type="text"
					   maxlength="256"
					   name="company"
					   id="company"
					   size="30"
					   class="form-control"
					   value="">
			</div>
			<div class="col-sm-6 form-group">
				<label for="services_provided">
					<?php echo esc_html_x( 'Services Provided', 'label', 'crmn-member-search' ); ?>
				</label>
				<select name="services_provided"
						id="services_provided"
						class="form-control">
					<option value="">Any</option>
					<option>Mediation</option>
					<option>Arbitration</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="additional_languages_spoken">
					<?php echo esc_html_x( 'General ADR Matters', 'label', 'crmn-member-search' ); ?>
				</label>
				<?php
				/**
				 * These should probably be pulled from wherever our account form options are coming from.
				 */
				?>
				<select name="general_adr_matters" id="general_adr_matters" class="form-control">
					<option value="">Any</option>
					<?php

					$general_adr_matters = array(
						'Family matter – married and non-married',
						'Business to Business',
						'Business to Consumer',
						'Neighbor/Neighborhood',
						'Employment',
						'Juvenile',
						'School Issue',
						'Elder Issue',
						'Real Estate',
						'Landlord Tenant',
						'Personal Injury/Torts',
						'Government/Courts',
						'Civil Rights/EEOC',
						'Group(s)',
						'Guardianship/Conservatorship',
						'Health Care',
					);

					foreach ( $general_adr_matters as $matter ) {
						echo '<option value="' . esc_attr( $matter ) . '">' . esc_html( $matter ) . '</option>';
					}
					?>
				</select>
			</div>
			<div class="col-sm-6 form-group">
				<label for="detailed_adr_matters">
					<?php echo esc_html_x( 'Detailed ADR Matters', 'label', 'crmn-member-search' ); ?>
				</label>
				<?php
				/**
				 * These should probably be pulled from wherever our account form options are coming from.
				 */
				?>
				<select name="detailed_adr_matters" id="detailed_adr_matters" class="form-control">
					<option value="">Any</option>

					<?php

					$detailed_adr_matters = array(
						'ADR Training',
						'Arbitration / Mediation (Arb Med)',
						'Circles',
						'Collaborative Law',
						'Consensual Special Magistrate',
						'Custody, Support or Property Division',
						'Divorce',
						'Divorce Arbitration',
						'Early Neutral Evaluation',
						'Early neutral Evaluation – Custody',
						'Early neutral Evaluation – Financial',
						'Elder / family issues',
						'Elder / medical issues',
						'Elder care',
						'Employment',
						'Group Facilitator',
						'Labor/Management',
						'Large Group',
						'Mediation / Arbitration (Med Arb)',
						'Mini-Trial',
						'Neutral Fact Finding',
						'Non-binding Advisory Opinion',
						'Organizational Development',
						'Parenting Consultant',
						'Parenting Time Expediter',
						'Post Divorce',
						'Restorative Justice	Summary',
						'Jury Trial',
						'Transformative Mediation',
						'Worker\'s Compensation',
					);

					foreach ( $detailed_adr_matters as $matter ) {
						echo '<option value="' . esc_attr( $matter ) . '">' . esc_html( $matter ) . '</option>';
					}

					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="additional_languages_spoken">
					<?php echo esc_html_x( 'Languages Spoken', 'label', 'crmn-member-search' ); ?>
				</label>
				<?php
				/**
				 * These should probably be pulled from wherever our account form options are coming from.
				 */
				?>
				<select name="additional_languages_spoken" id="additional_languages_spoken" class="form-control">
					<option value="">Any</option>
					<?php

					$additional_languages = array(
						'Chinese',
						'Hmong',
						'Laotian',
						'Ojibwa',
						'Russian',
						'Siouan',
						'Somali',
						'Spanish',
						'Vietnamese',
					);

					foreach ( $additional_languages as $language ) {
						echo '<option value="' . esc_attr( $language ) . '">' . esc_html( $language ) . '</option>';
					}

					?>
				</select>
			</div>
			<div class="col-sm-6 form-group">&nbsp;</div>
		</div>

		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="search-center">
					<?php echo esc_html_x( 'Full address, City & State, or Zip Code', 'label', 'crmn-member-search' ); ?>
				</label>
				<input type="text" maxlength="256" name="search-center" id="search-center" size="30"
					   class="form-control" value="">
			</div>
			<div class="col-sm-6 form-group">
				<label for="search-radius">
					<?php echo esc_html_x( 'Within Radius Miles (optional)', 'label', 'crmn-member-search' ); ?>
				</label>
				<select name="search-radius"
						id="search-radius"
						class="form-control">
					<?php
					/**
					 * These radius options seem reasonable.
					 */
					?>
					<option value="">
						Select a Radius
					</option>
					<option value="10">
						10 Miles
					</option>
					<option value="25">
						25 Miles
					</option>
					<option value="50">
						50 Miles
					</option>
					<option value="100">
						100 Miles
					</option>
					<option value="200">
						200 Miles
					</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input"  name="is_member_of_acr_international" id="is_member_of_acr_international" value="1">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description"><?php echo esc_html_x( 'Is a member of ACR International', 'label', 'crmn-member-search' ); ?></span>
				</label>
			</div>
			<div class="col-sm-6 form-group">
				<label class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input"  name="is_rule_114_qualified_neutral" id="is_rule_114_qualified_neutral" value="1">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description"><?php echo esc_html_x( 'Is a Rule 114 Qualified Neutral', 'label', 'crmn-member-search' ); ?></span>
				</label>
			</div>
		</div>

		<div class="row">
			<?php wp_nonce_field( 'crm-directory-search', 'crm-member-search' ); ?>
			<div class="col-xs-12 form-group">
				<input type="submit"
					   name="submit-directory-search"
					   id="submit-directory-search"
					   class="btn btn-default"
					   value="<?php echo esc_attr_x( 'Directory Search', 'submit button', 'crmn-member-search' ); ?>">
			</div>
		</div>
	</form>
</div>

<?php if ( $module::is_member_search() && ! empty( $search_results ) ) : ?>

	<h3>
		<?php esc_html_e( 'We found the following members within your specified search area', 'crm-member-search' ); ?>
	</h3>
	<h4>
		<em>
			<?php echo count( $search_results ); ?> Result<?php echo ( count( $search_results ) > 1 ? 's' : '' ); ?>
		</em>
	</h4>

	<?php foreach ( $search_results as $search_result ) : ?>
		<div class="search-result-members">
			<div class="name">
				<?php echo esc_html( $search_result->first_name ) . ' ' . esc_html( $search_result->last_name ); ?>
			</div>
			<?php if ( ! empty( $search_result->company ) ) : ?>
				<div class="company">
					-
					<em>
						<?php echo esc_html( $search_result->company ); ?>
					</em>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $search_result->geo_address ) ) : ?>
				<div class="address">
					<?php
					echo str_replace( ',', '<br/>', esc_html( $search_result->geo_address ) ); // ?
					?>
				</div>
			<?php endif; ?>
			<div class="details">
				<ul>
					<?php if ( ! empty( $search_result->is_member_of_acr_international ) ) : ?>
						<li>
							<label>
								<?php esc_html_e( 'Is a member of ACR International', 'crm-member-search' ); ?>
							</label>
						</li>
					<?php endif; ?>
					<?php if ( ! empty( $search_result->is_rule_114_qualified_neutral ) ) : ?>
						<li>
							<label>
								<?php esc_html_e( 'Is a Rule 114 Qualified Neutral', 'crm-member-search' ); ?>
							</label>
						</li>
					<?php endif; ?>


					<?php if ( ! empty( $search_result->additional_languages_spoken ) ) : ?>
						<li>
							<label>
								<?php esc_html_e( 'Additional Languages Spoken:', 'crm-member-search' ); ?>
							</label>
							<?php echo esc_html( $search_result->additional_languages_spoken ); ?>
						</li>
					<?php endif; ?>


					<?php if ( ! empty( $search_result->services_provided ) ) : ?>
						<li>
							<label>
								<?php esc_html_e( 'Services Provided:', 'crm-member-search' ); ?>
							</label>
							<?php echo esc_html( $search_result->services_provided ); ?>
						</li>
					<?php endif; ?>
					<?php if ( ! empty( $search_result->general_adr_matters ) ) : ?>
						<li>
							<label>
								<?php esc_html_e( 'General ADR Matters:', 'crm-member-search' ); ?>
							</label>
							<?php echo esc_html( $search_result->general_adr_matters ); ?>
						</li>
					<?php endif; ?>
					<?php if ( ! empty( $search_result->detailed_adr_matters ) ) : ?>
						<li>
							<label>
								<?php esc_html_e( 'Detailed ADR Matters:', 'crm-member-search' ); ?>
							</label>
							<?php echo esc_html( $search_result->detailed_adr_matters ); ?>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
