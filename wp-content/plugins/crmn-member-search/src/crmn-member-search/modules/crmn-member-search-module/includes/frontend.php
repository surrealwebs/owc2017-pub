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
	 *     'first-name'              => 'Richard'
	 *     'last-name'               => 'Aber'
	 *     'company'                 => 'Nerdery'
	 *     'services-provided'       => 'mediation'
	 *     'areas-of-expertise'      => 'training'
	 *     'additional-languages'    => 'chinese'
	 *     'search-center'           => '55431'
	 *     'search-radius'           => '5'
	 *     'crm-member-search'       => 'e88cef0fa3'
	 *     '_wp_http_referer'        => '/'
	 *     'submit-directory-search' => 'Directory Search'
	 * )
	 *
	 * @var array $search_query
	 */
	$directory_search_user_query = $module::get_directory_search_user_query();
	// error_log( 'directory_search_query = ' . print_r( $directory_search_query, true ) );

	if ( ! empty( $directory_search_user_query ) ) {
//		$module::get_directory_search_db_query( $directory_search_user_query );
		$geocoder = new CRMN_Member_Search_Geocoder();
		$geocode_address = $geocoder->geocode_address( $directory_search_user_query['search-center'] );
//		error_log( '$geocode_address = ' . print_r( $geocode_address, true ) );
	}

	if ( ! empty( $geocode_address ) ) {
		$test = $module::get_geodata_radius_search( $geocode_address['geo_latitude'], $geocode_address['geo_longitude'], $directory_search_user_query['search-radius'] );
		error_log( '$test = ' . print_r( $test, true ) );
	}

	// $module::get_geodata_radius_search();
}

?>

<div id="<?php echo esc_attr( $id ); ?>" class="crmn-directory-wrapper">

	<form role="search"
		  class="form-horizontal"
		  action=""
		  accept-charset="UTF-8"
		  method="post"
		  id="crm-directory-search-<?php echo esc_attr( $id ); ?>">

		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="first-name">
					<?php echo esc_html_x( 'First Name', 'label', 'crmn-member-search' ); ?>
				</label>
				<input type="text"
					   maxlength="256"
					   name="first-name"
					   id="first-name"
					   class="form-control"
					   value="">
			</div>
			<div class="col-sm-6 form-group">
				<label for="last-name">
					<?php echo esc_html_x( 'Last Name', 'label', 'crmn-member-search' ); ?>
				</label>
				<input type="text"
					   maxlength="256"
					   name="last-name"
					   id="last-name"
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
				<label for="services-provided">
					<?php echo esc_html_x( 'Services Provided', 'label', 'crmn-member-search' ); ?>
				</label>
				<select name="services-provided"
						id="services-provided"
						class="form-control">
					<option value="">
						Any
					</option>
					<option value="mediation">
						Mediation
					</option>
					<option value="arbitration">
						Arbitration
					</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="areas-of-expertise">
					<?php echo esc_html_x( 'Areas of Expertise', 'label', 'crmn-member-search' ); ?>
				</label>
				<?php
				/**
				 * These should probably be pulled from wherever our account form options are coming from.
				 */
				?>
				<select name="areas-of-expertise"
						id="areas-of-expertise"
						class="form-control">
					<option value="">
						Any
					</option>
					<option value="training">
						ADR Training
					</option>
					<option value="arbmed">
						Arbitration / Mediation (Arb Med)
					</option>
					<option value="circles">
						Circles
					</option>
					<option value="collab-law">
						Collaborative Law
					</option>
					<option value="consensual-spec-mag">
						Consensual Special Magistrate
					</option>
					<option value="custody-support-prop">
						Custody, Support or Property Division
					</option>
					<option value="divorce">
						Divorce
					</option>
					<option value="divorce-arb">
						Divorce Arbitration
					</option>
					<option value="early-neutral">
						Early Neutral Evaluation
					</option>
					<option value="early-neutral-=custody">
						Early neutral Evaluation – Custody
					</option>
					<option value="early-neutral-financ">
						Early neutral Evaluation – Financial
					</option>
					<option value="elder-family">
						Elder / family issues
					</option>
					<option value="elder-medical">
						Elder / medical issues
					</option>
					<option value="elder-care">
						Elder care
					</option>
					<option value="employment">
						Employment
					</option>
					<option value="group-facil">
						Group Facilitator
					</option>
					<option value="labor-mgmt">
						Labor/Management
					</option>
					<option value="lg-group">
						Large Group
					</option>
					<option value="med-arb">
						Mediation / Arbitration (Med Arb)
					</option>
					<option value="mini-trial">
						Mini-Trial
					</option>
					<option value="neutral-fact">
						Neutral Fact Finding
					</option>
					<option value="nb-advisory">
						Non-binding Advisory Opinion
					</option>
					<option value="org-devel">
						Organizational Development
					</option>
					<option value="parenting-consult">
						Parenting Consultant
					</option>
					<option value="parenting-time-exp">
						Parenting Time Expediter
					</option>
					<option value="post-divorce">
						Post Divorce
					</option>
					<option value="restorative-justice">
						Restorative Justice
					</option>
					<option value="summ-jury">
						Summary Jury Trial
					</option>
					<option value="transform-med">
						Transformative Mediation
					</option>
					<option value="worker-comp">
						Worker's Compensation
					</option>
				</select>
			</div>
			<div class="col-sm-6 form-group">
				<label for="additional-languages">
					<?php echo esc_html_x( 'Languages Spoken', 'label', 'crmn-member-search' ); ?>
				</label>
				<?php
				/**
				 * These should probably be pulled from wherever our account form options are coming from.
				 */
				?>
				<select name="additional-languages"
						id="additional-languages"
						class="form-control">
					<option value="">
						Any
					</option>
					<option value="chinese">
						Chinese
					</option>
					<option value="hmong">
						Hmong
					</option>
					<option value="laotian">
						Laotian
					</option>
					<option value="ojibwa">
						Ojibwa
					</option>
					<option value="russian">
						Russian
					</option>
					<option value="siouan">
						Siouan
					</option>
					<option value="somali">
						Somali
					</option>
					<option value="spanish">
						Spanish
					</option>
					<option value="vietnamese">
						Vitenamese
					</option>
				</select>
			</div>
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

<?php if ( $module::is_member_search() ) : ?>

	<div>
		<h1>
			Output results here!
		</h1>
	</div>

<?php endif; ?>
