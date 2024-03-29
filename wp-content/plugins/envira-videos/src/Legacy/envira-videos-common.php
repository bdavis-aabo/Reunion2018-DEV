<?php
if ( ! class_exists( 'Envira_Videos_Common' ) ) :
	class Envira_Videos_Common {

		/**
		 * _instance
		 *
		 * (default value: null)
		 *
		 * @var mixed
		 * @access public
		 * @static
		 */
		public static $_instance = null;

		/**
		 * Adds the default settings for this addon.
		 *
		 * @since 1.0.0
		 *
		 * @param array $defaults  Array of default config values.
		 * @param int   $post_id     The current post ID.
		 * @return array $defaults Amended array of default config values.
		 */
		function defaults( $defaults, $post_id ) {

			// Add Videos default settings to main defaults array
			$defaults['videos_play_icon'] = 0;
			$defaults['videos_autoplay']  = 0;
			$defaults['videos_enlarge']   = 0;
			$defaults['videos_playpause'] = 1;
			$defaults['videos_progress']  = 1;
			$defaults['videos_current']   = 1;
			$defaults['videos_duration']  = 1;
			$defaults['videos_volume']    = 1;

			// Return
			return $defaults;

		}

		/**
		 * Returns an array of self hosted video supported file types
		 * Edit this to extend support, but bear in mind mediaelementplayer's limitations
		 *
		 * @since 1.0.0
		 *
		 * @return array Supported File Types
		 */
		public function get_self_hosted_supported_filetypes() {

			$file_types = array(
				'mp4',
				'flv',
				'ogv',
				'webm',
			);

			$file_types = apply_filters( 'envira_videos_self_hosted_supported_filetypes', $file_types );

			return $file_types;

		}

		/**
		 * Converts the given array to a string
		 *
		 * @since 1.0.0
		 *
		 * @param string $glue Glue to join array values together
		 * @return string Supported File Types
		 */
		public function get_self_hosted_supported_filetypes_string( $glue = '|' ) {

			$file_types     = $this->get_self_hosted_supported_filetypes();
			$file_types_str = '';
			foreach ( $file_types as $file_type ) {
				$file_types_str .= '.' . $file_type . $glue;
			}

			// Trim final glue
			if ( ! empty( $glue ) ) {
				$file_types_str = rtrim( $file_types_str, $glue );
			}

			return $file_types_str;

		}

		/**
		 * Returns the video type an other attributes for the given video URL
		 *
		 * @since 1.0.0
		 *
		 * @param string $url Video URL
		 * @param array  $item Gallery Item
		 * @param array  $data Gallery Data
		 * @param bool   $type_only Only return the video type
		 * @return mixed (array) Video Attributes, (string) Video Type, (bool) Unsupported Video Type
		 */
		public function get_video_type( $url, $item = false, $data = false, $type_only = false ) {

			$result = false;
			$regex  = $this->get_self_hosted_supported_filetypes_string();
			$slug   = false;

			if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $y_matches ) ) {
				// YouTube
				$video_id_temp = $y_matches[1];

				// Rip out any added query string values
				if ( strpos( $video_id_temp, '?v=' ) !== false || strpos( $video_id_temp, '?vi=' ) !== false ) {
					$video_id = $video_id_temp;
				} else {
					$video_id_array = explode( '?', $video_id_temp );
					$video_id       = $video_id_array[0];
				}

				$type = 'youtube';

				if ( $type_only ) {
					return $type;
				}

				$embed_url = esc_url( add_query_arg( $this->get_youtube_args( $data ), '//youtube.com/embed/' . $y_matches[1] ) );
			} elseif ( preg_match( '#(?:https?:\/\/(?:[\w]+\.)*vimeo\.com(?:[\/\w]*\/videos?)?\/([0-9]+)[^\s]*)#i', $url, $v_matches ) ) {
				// Vimeo
				$video_id = $v_matches[1];
				$type     = 'vimeo';

				if ( $type_only ) {
					return $type;
				}

				$embed_url = esc_url( add_query_arg( $this->get_vimeo_args( $data ), '//player.vimeo.com/video/' . $v_matches[1] ) );
			} elseif ( preg_match( '/https?:\/\/(.+)?(wistia.com|wi.st)\/.*/i', $url, $w_matches ) ) {
				// Wistia
				$parts    = explode( '/', $w_matches[0] );
				$video_id = array_pop( $parts );
				$type     = 'wistia';

				if ( $type_only ) {
					return $type;
				}

				$embed_url = esc_url( add_query_arg( $this->get_wistia_args( $data ), '//fast.wistia.net/embed/iframe/' . $video_id ) );

			} elseif ( preg_match( '/(instagr\.am|instagram\.com)\/p\/([a-zA-Z0-9_\-]+)\/?/i', $url, $i_matches ) ) {
				// Instagram
				$parts    = explode( '/', $i_matches[0] );
				$video_id = $i_matches[2];
				$type     = 'instagram';
				$mp4_link = false;

				if ( $type_only ) {
					return $type;
				}

				// Get page data from instagram to find mp4
				$page_data = wp_remote_get(
					$url,
					array(
						'timeout' => 10,
					)
				);

				$doc = new DOMDocument();
				@$doc->loadHTML( $page_data['body'] );
				$metas = $doc->getElementsByTagName( 'meta' );

				for ( $i = 0; $i < $metas->length; $i++ ) {
					$meta = $metas->item( $i );
					if ( $meta->getAttribute( 'property' ) == 'og:video' ) {
						$mp4_link = $meta->getAttribute( 'content' );
					}
					if ( $meta->getAttribute( 'property' ) == 'og:video:secure_url' ) {
						$mp4_link = $meta->getAttribute( 'content' );
					}
				}

				$embed_url = $mp4_link; // esc_url( add_query_arg( $this->get_instagram_args( $data ), '//fast.wistia.net/embed/iframe/' . $video_id ) );

			} elseif ( preg_match( '/dailymotion.com\/video\/(.*)\/?(.*)/', $url, $d_matches ) ) {
				// DailyMotion
				$parts    = explode( '/', $d_matches[0] );
				$video_id = $d_matches[1];
				$type     = 'dailymotion';

				if ( $type_only ) {
					return $type;
				}

				$embed_url = esc_url( add_query_arg( $this->get_dailymotion_args( $data ), '//www.dailymotion.com/video/' . $d_matches[1] ) );
			} elseif ( preg_match( '/metacafe.com\/watch\/(\d+)\/(.*)?/', $url, $m_matches ) ) {
				// Metacafe
				$parts    = explode( '/', $m_matches[0] );
				$video_id = $m_matches[1];
				$slug     = $m_matches[2];
				$type     = 'metacafe';

				if ( $type_only ) {
					return $type;
				}

				$embed_url = esc_url( add_query_arg( $this->get_metacafe_args( $data ), '//www.metacafe.com/watch/' . $m_matches[1] . '/' . $slug ) );

			} elseif ( preg_match( '/(' . $regex . ')/', $url, $matches ) ) {
				// Self hosted
				$parts = explode( '.', $matches[0] );
				$type  = $parts[1];

				if ( $type_only ) {
					return $type;
				}

				$video_id  = 0;
				$embed_url = $url;
			} else {
				// Not a video
				if ( $type_only ) {
					return false;
				}
			}

			// If a video type was found, return an array of video attributes
			if ( isset( $type ) ) {
				$result = array(
					'type'      => $type,
					'video_id'  => $video_id,
					'embed_url' => $embed_url,
					'slug'      => $slug,
				);
			}

			// Allow devs and custom addons to build their own routine for populating attribute data for their custom video type
			$result = apply_filters( 'envira_videos_get_video_type', $result, $url, $item, $data );

			return $result;

		}

		/**
		 * Returns the query args to be passed to YouTube embedded videos.
		 *
		 * @since 1.0.0
		 *
		 * @param array $data Array of gallery data.
		 */
		public function get_youtube_args( $data ) {

			// Get instance
			$instance = Envira_Gallery_Shortcode::get_instance();

			$args = array(
				'autoplay'       => $instance->get_config( 'videos_autoplay', $data ),
				'controls'       => $instance->get_config( 'videos_playpause', $data ),
				'enablejsapi'    => 1,
				'modestbranding' => 1,
				'origin'         => get_home_url(),
				'rel'            => 0,
				'showinfo'       => 0,
				'version'        => 3,
				'wmode'          => 'transparent',
			);

			return apply_filters( 'envira_videos_youtube_args', $args, $data );

		}

		/**
		 * Returns the query args to be passed to Vimeo embedded videos.
		 *
		 * @since 1.0.0
		 *
		 * @param array $data Array of gallery data.
		 */
		public function get_vimeo_args( $data ) {

			$args = array(
				'autoplay'   => Envira_Gallery_Shortcode::get_instance()->get_config( 'videos_autoplay', $data ),
				'badge'      => 0,
				'byline'     => 0,
				'portrait'   => 0,
				'title'      => 0,
				'api'        => 1,
				'wmode'      => 'transparent',
				'fullscreen' => 1,
			);

			return apply_filters( 'envira_videos_vimeo_args', $args, $data );

		}

		/**
		 * Returns the query args to be passed to Instagram embedded videos.
		 *
		 * @since 1.0.0
		 *
		 * @param array $data Array of gallery data.
		 */
		public function get_instagram_args( $data ) {

			$args = array(
				'autoplay'   => Envira_Gallery_Shortcode::get_instance()->get_config( 'videos_autoplay', $data ),
				'badge'      => 0,
				'byline'     => 0,
				'portrait'   => 0,
				'title'      => 0,
				'api'        => 1,
				'wmode'      => 'transparent',
				'fullscreen' => 1,
			);

			return apply_filters( 'envira_videos_instagram_args', $args, $data );

		}

		/**
		 * Returns the query args to be passed to Wistia embedded videos.
		 *
		 * @since 1.0.0
		 *
		 * @param array $data Array of gallery data.
		 */
		public function get_wistia_args( $data ) {

			// Get instance
			$instance = Envira_Gallery_Shortcode::get_instance();

			$args = array(
				'autoPlay'        => $instance->get_config( 'videos_autoplay', $data ) ? 'true' : 'false',
				'chromeless'      => 'false', // Controls
				'playbar'         => $instance->get_config( 'videos_progress', $data ) ? 'true' : 'false',
				'smallPlayButton' => $instance->get_config( 'videos_playpause', $data ) ? 'true' : 'false',
				'videoFoam'       => 'true',
				'volumeControl'   => $instance->get_config( 'videos_volume', $data ) ? 'true' : 'false',
				'wmode'           => 'opaque',
			);

			return apply_filters( 'envira_videos_wistia_args', $args, $data );

		}


		/**
		 * Returns the query args to be passed to DailyMotion embedded videos.
		 *
		 * @since 1.0.0
		 *
		 * @param array $data Array of gallery data.
		 */
		public function get_dailymotion_args( $data ) {

			// Get instance
			$instance = Envira_Gallery_Shortcode::get_instance();

			$args = array(
				'autoplay'         => $instance->get_config( 'videos_autoplay', $data ),
				'controls'         => $instance->get_config( 'videos_playpause', $data ),
				'ui-theme'         => 'dark',
				'wmode'            => 'transparent',
				'endscreen-enable' => 1,
			);
			return apply_filters( 'envira_videos_dailymotion_args', $args, $data );

		}

		/**
		 * Returns the query args to be passed to DailyMotion embedded videos.
		 *
		 * @since 1.0.0
		 *
		 * @param array $data Array of gallery data.
		 */
		public function get_metacafe_args( $data ) {

			// Get instance
			$instance = Envira_Gallery_Shortcode::get_instance();

			$args = array(
				'autoplay' => $instance->get_config( 'videos_autoplay', $data ),
				'controls' => $instance->get_config( 'videos_playpause', $data ),
				'wmode'    => 'transparent',
			);
			return apply_filters( 'envira_videos_metacafe_args', $args, $data );

		}

		/**
		 * Returns the query args to be passed to embedded / self hosted videos
		 *
		 * @since 1.0.0
		 *
		 * @param array  $data Array of gallery data.
		 * @param string $url Video URL
		 */
		public function get_embed_args( $data, $url ) {

			$args = array(
				'url' => urlencode( $url ),
			);

			return apply_filters( 'envira_videos_embed_args', $args, $data, $url );

		}

		/**
		 * Returns the singleton instance of the class.
		 *
		 * @since 1.0.0
		 *
		 * @return object The Envira_Videos_Common object.
		 */
		public static function get_instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Envira_Videos_Common ) ) {
				self::$instance = new Envira_Videos_Common();
			}

			return self::$instance;

		}


	}
endif;
