<?php
/**
 * WordPress Dashboard Widget for BackupBuddy
 *
 * @package BackupBuddy
 */

?>
<?php if ( false !== backupbuddy_live::getLiveID() ) : ?>
	<div class="tabs clearfix">
		<button class="tab-toggle stash-live selected">Stash Live</button>
		<button class="tab-toggle traditional">Traditional</button>
	</div>
	<div class="stash-live-wrapper"><div class="spinner is-active"></div></div>
	<script type="text/template" class="backupbuddy-stash-live-dashboard-widget-tmpl">
		<div class="backupbuddy-live-stats-currently">
			<span class="backupbuddy-pulsing-orb"></span>
			<div class="backupbuddy-currently-message">
				<span class="backupbuddy-inline-label"><?php esc_html_e( 'Currently', 'it-l10n-backupbuddy' ); ?></span>: {{ stats.current_function_pretty }}
			</div>
		</div>
		<div class="backupbuddy-live-stats-overview">
			<h3><?php esc_html_e( 'BackupBuddy Stash Live requested new snapshot files', 'it-l10n-backupbuddy' ); ?>:</h3>
			<div class="backupbuddy-stats-time-ago">{{ stats.last_remote_snapshot_ago }}</div>

			<div class="backupbuddy-stats-overview-manage-live backup-now">
				<a href="<?php echo esc_url( $stashlive_url ); ?>" class="backupbuddy-live-button secondary"><?php esc_html_e( 'Manage Stash Live', 'it-l10n-backupbuddy' ); ?></a>
			</div>
		</div>
	</script>
<?php endif; ?>

<div class="traditional-backup-wrapper hidden">
	<div class="edits-since-wrapper">
		<p class="edits-since <?php echo esc_attr( $status ); ?>">
			<?php echo esc_html( $get_overview['editsSinceLastBackup'] ); ?>
		</p>
		<h4 class="number-heading">Edits since<br>last Backup</h4>
	</div>
	<?php if ( isset( $get_overview['lastBackupStats']['finish'] ) ) { // only show if a last backup exists. ?>
		<div class="info-group">
			<h3>Latest Backup</h3>
			<ul class="backup-list">
				<li>
					<div class="list-wrapper">
						<div class="list-title">
							<?php echo $last_backup_title; // @codingStandardsIgnoreLine: ok. ?>
						</div>
						<div class="list-description">
							<div class="backup-type description-item">
								<span>Type</span><br>
								<?php echo esc_html( $backup_type ); ?>
							</div>
							<div class="backup-size description-item">
								<span>Size</span><br>
								<?php echo esc_html( $archive_size ); ?>
							</div>
							<div class="backup-time description-item">
								<span>Time</span><br>
								<?php echo esc_html( $time_nice ); ?>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	<?php } ?>

	<div class="backup-now">
		<a href="<?php echo esc_url( $backup_url ); ?>"><?php esc_html_e( 'Backup Now', 'it-l10n-backupbuddy' ); ?></a>
	</div>
</div>

<?php if ( false !== backupbuddy_live::getLiveID() ) : ?>
	<script>
		function backupbuddy_live_dashboard_stats( stats ) {
			_.templateSettings.variable    = 'stats';
			_.templateSettings.evaluate    = /<#([\s\S]+?)#>/g;
			_.templateSettings.interpolate = /\{\{\{([\s\S]+?)\}\}\}/g;
			_.templateSettings.escape      = /\{\{([^\}]+?)\}\}(?!\})/g;
			var liveTemplate = _.template( jQuery( '#pb_backupbuddy_stats .backupbuddy-stash-live-dashboard-widget-tmpl' ).html() );
			jQuery('#pb_backupbuddy_stats .stash-live-wrapper' ).html( liveTemplate( stats ) );
		}

		jQuery(document).ready( function() {
			backupbuddy_live_dashboard_stats( jQuery.parseJSON( '<?php echo json_encode( backupbuddy_api::getLiveStats() ); ?>' ) ); // Initial stats to prevent loading from showing.
		});
	</script>
	<?php require_once pb_backupbuddy::plugin_path() . '/destinations/live/_statsPoll.php'; ?>
<?php endif; ?>

<script>
	jQuery(document).ready( function() {
		// UI for toggling the tabs
		jQuery( '#pb_backupbuddy_stats .tab-toggle' ).on( 'click', function( e ) {
			e.preventDefault();
			if ( jQuery(this).hasClass( 'stash-live' ) ) {
				jQuery(this).addClass('selected').siblings().removeClass('selected');
				jQuery( '#pb_backupbuddy_stats .stash-live-wrapper').removeClass('hidden');
				jQuery( '#pb_backupbuddy_stats .traditional-backup-wrapper').addClass('hidden');
			} else if ( jQuery(this).hasClass( 'traditional' ) ) {
				jQuery(this).addClass('selected').siblings().removeClass('selected');
				jQuery( '#pb_backupbuddy_stats .traditional-backup-wrapper').removeClass('hidden');
				jQuery( '#pb_backupbuddy_stats .stash-live-wrapper').addClass('hidden');
			}
		});

		<?php if ( false === backupbuddy_live::getLiveID() ) : ?>
			jQuery( '#pb_backupbuddy_stats .traditional-backup-wrapper').removeClass('hidden');
		<?php endif; ?>
	});
</script>
