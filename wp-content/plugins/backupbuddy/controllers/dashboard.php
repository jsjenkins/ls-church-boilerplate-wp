<?php
/**
 * Dashboard Widgets
 *
 * @package BackupBuddy
 */

/**
 * Dashboard Widgets for BackupBuddy
 */
class pb_backupbuddy_dashboard extends pb_backupbuddy_dashboardcore {

	/**
	 * Displays (echos out) an overview of stats into the WordPress Dashboard.
	 */
	public function stats() {

		pb_backupbuddy::load_script( 'underscore' );

		$get_overview = backupbuddy_api::getOverview();

		if ( is_network_admin() ) {
			$backup_url = network_admin_url( 'admin.php' );
		} else {
			$backup_url = admin_url( 'admin.php' );
		}
		$backup_url .= '?page=pb_backupbuddy_backup';

		if ( is_network_admin() ) {
			$stashlive_url = network_admin_url( 'admin.php' );
		} else {
			$stashlive_url = admin_url( 'admin.php' );
		}
		$stashlive_url .= '?page=pb_backupbuddy_live';

		// Red-Green status for editsSinceLastBackup.
		if ( 0 == $get_overview['editsSinceLastBackup'] ) {
			$status = 'green';
		} else {
			$status = 'red';
		}

		// Format file archiveSize to readable format.
		if ( isset( $get_overview['lastBackupStats']['archiveSize'] ) && is_numeric( $get_overview['lastBackupStats']['archiveSize'] ) ) {
			$file_size = $get_overview['lastBackupStats']['archiveSize'];

			if ( $file_size >= 1073741824 ) {
				$archive_size = round( $file_size / 1024 / 1024 / 1024, 2 ) . ' GB';

			} elseif ( $file_size >= 1048576 ) {
				$archive_size = round( $file_size / 1024 / 1024, 1 ) . ' MB';

			} elseif ( $file_size >= 1024 ) {
				$archive_size = round( $file_size / 1024, 0 ) . ' KB';

			} else {
				$archive_size = $file_size . ' bytes';
			}
		} else {
			$archive_size = 'Unknown';
		}

		// Format timestamp.
		if ( isset( $get_overview['lastBackupStats']['finish'] ) ) {
			$time      = pb_backupbuddy::$format->localize_time( $get_overview['lastBackupStats']['finish'] );
			$time_nice = date( 'M j - g:i A', $time );
		} else {
			$time_nice = 'Unknown';
		}

		// Format Type.
		if ( isset( $get_overview['lastBackupStats']['type'] ) ) {
			if ( 'full' === $get_overview['lastBackupStats']['type'] ) {
				$backup_type = 'Full';
			} elseif ( 'db' === $get_overview['lastBackupStats']['type'] ) {
				$backup_type = 'Database';
			} else {
				$backup_type = $get_overview['lastBackupStats']['type'];
			}
		} else {
			$backup_type = 'Unknown';
		}

		$last_backup_title = '<i>' . esc_html__( 'Stored offsite or deleted', 'it-l10n-backupbuddy' ) . '</i>';

		if ( isset( $get_overview['lastBackupStats']['archiveFile'] ) && file_exists( backupbuddy_core::getBackupDirectory() . $get_overview['lastBackupStats']['archiveFile'] ) ) {
			$last_backup_title = '<a href="';
			if ( isset( $get_overview['lastBackupStats']['archiveURL'] ) ) {
				$last_backup_title .= esc_url( $get_overview['lastBackupStats']['archiveURL'] );
			}
			$last_backup_title .= '">';
			$last_backup_title .= esc_html__( 'Download', 'it-l10n-backupbuddy' );
			$last_backup_title .= '</a>';
		}

		// Build widget markup.
		ob_start();

		include pb_backupbuddy::plugin_path() . '/views/widgets/dashboard.php';

		ob_end_flush();
	}
}
