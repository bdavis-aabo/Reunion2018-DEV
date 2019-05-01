/**
 * Handles:
 * - Inline Video Help
 *
 * @since 1.5.0
 */

// Setup vars
var envira_video_link       = 'p.envira-intro a.envira-video',
	envira_close_video_link = 'a.envira-video-close';

jQuery( document ).ready(
	function ($) {
		/**
		* Display Video Inline on Video Link Click
		*/
		$( document ).on(
			'click',
			envira_video_link,
			function (e) {

				// Prevent default action
				e.preventDefault();

				// Get the video URL
				var envira_video_url = $( this ).attr( 'href' );

				// Destroy any other instances of Envira Video iframes
				$( 'div.envira-video-help' ).remove();

				// Get the intro paragraph
				var envira_video_paragraph = $( this ).closest( 'p.envira-intro' );

				// Load the video below the intro paragraph on the current tab
				$( envira_video_paragraph ).append( '<div class="envira-video-help"><iframe src="' + envira_video_url + '" /><a href="#" class="envira-video-close dashicons dashicons-no"></a></div>' );

			}
		);

		/**
		* Destroy Video when closed
		*/
		$( document ).on(
			'click',
			envira_close_video_link,
			function (e) {

				e.preventDefault();

				$( this ).closest( '.envira-video-help' ).remove();

			}
		);

	}
);
