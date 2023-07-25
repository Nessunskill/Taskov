<?php
require_once(TASKBOT_API_DIRECTORY . 'libraries/jwt/vendor/autoload.php');
/** Requiere the JWT library. */

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

/**
 * APP API for Tasksbot
 *
 * This file will include all global settings which will be used in all over the plugin,
 * It have gatter and setter methods
 *
 * @link              https://codecanyon.net/user/amentotech/portfolio
 * @since             1.0.0
 * @package           Taskbot APP
 *
 */
if (!class_exists('TaskbotApiTaskbot')) {
	class TaskbotApiTaskbot extends WP_REST_Controller
	{

		/**
		 * private key for jwt.
		 *
		 * @since    1.0.0
		 * @access   private
		 * @var      string    $secretKey   secret key for jwt.
		 */
		private $secretKey;
		public function __construct()
		{
			$this->secretKey 		= 'y),LjN6*Zi/_YXKxTU_SkQ8F[q|du@/4DH*_v4qwJ}A';
		}

		public function register_routes()
		{
			$version 	= TASKBOT_API_KEY;
			$namespace 	= 'api/v' . $version;

			// User login
			register_rest_route(
				$namespace,
				'/user-login',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'userAuth'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update profile
			register_rest_route(
				$namespace,
				'/update-profile',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'updateProfile'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update education
			register_rest_route(
				$namespace,
				'/update-education',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'updateEducation'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update billing details
			register_rest_route(
				$namespace,
				'/update-billing-details',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'updateBilingDetails'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update privacy settings
			register_rest_route(
				$namespace,
				'/update-privacy',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'updatePrivacySettings'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update privacy settings
			register_rest_route(
				$namespace,
				'/update-account',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'updateUserSettings'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);
			// Update privacy settings
			register_rest_route(
				$namespace,
				'/update-settings',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'updateSettings'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update privacy settings
			register_rest_route(
				$namespace,
				'/update-verification',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'sendVerification'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);
			// List invoices
			register_rest_route(
				$namespace,
				'/invoices-list',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'listInvoices'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Get orders
			register_rest_route(
				$namespace,
				'/get-orders',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getOrders'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// List order comments
			register_rest_route(
				$namespace,
				'/get-order-comments',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getOrderComments'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Get Dispute
			register_rest_route(
				$namespace,
				'/get-disputes',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getDisputes'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update dispute comments
			register_rest_route(
				$namespace,
				'/update-dispute-comments',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'UpdateDisputeComment'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Create dispute
			register_rest_route(
				$namespace,
				'/create-dispute',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'createDispute'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update dispute
			register_rest_route(
				$namespace,
				'/update-dispute',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'updateDisputeStatus'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);


			// Get billings
			register_rest_route(
				$namespace,
				'/get-billing',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getBilling'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Get billings
			register_rest_route(
				$namespace,
				'/get-attachments',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'downloadAttachments'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update activities
			register_rest_route(
				$namespace,
				'/update-activities',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'UpdateActivities'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			/* create task */
			register_rest_route(
				$namespace,
				'/create-task',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'create_task'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			/* delete task */
			register_rest_route(
				$namespace,
				'/delete-task',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'delete_task'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			/* change task status on/off */
			register_rest_route(
				$namespace,
				'/task-status-change',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'task_status_change'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			/* create sub-task */
			register_rest_route(
				$namespace,
				'/create-sub-task',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'create_sub_task'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			/* get tasks */
			register_rest_route(
				$namespace,
				'/get_tasks',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'get_tasks'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			/* get task data */
			register_rest_route(
				$namespace,
				'/get-task-data',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'get_task_data'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Task complete
			register_rest_route(
				$namespace,
				'/task-complete',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'taskComplete'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//Task cancelled
			register_rest_route(
				$namespace,
				'/task-cancelled',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'taskCancelled'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Get billings
			register_rest_route(
				$namespace,
				'/get-balance',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'get_balance'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//Payout settings 
			register_rest_route(
				$namespace,
				'/get_payout_setting',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'get_payout_setting'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//Update payout settings 
			register_rest_route(
				$namespace,
				'/update_payout_setting',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'update_payout_setting'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);
			// Fund request
			register_rest_route(
				$namespace,
				'/fund-request',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'fundRequest'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//Get payout
			register_rest_route(
				$namespace,
				'/get-payout',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'get_payout'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update milestone
			register_rest_route(
				$namespace,
				'/update-milestone',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'updateMilestone'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update saved option
			register_rest_route(
				$namespace,
				'/update-saveditem',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'updateSavedItems'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//Forget password
			register_rest_route(
				$namespace,
				'/get-password',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'forgetPassword'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Profile image
			register_rest_route(
				$namespace,
				'/upload-avatar',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'uploadAvatar'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Switch user
			register_rest_route(
				$namespace,
				'/switch-user',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'switchUser'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Switch user
			register_rest_route(
				$namespace,
				'/get-saved-items',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getSavedItems'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Profile image
			register_rest_route(
				$namespace,
				'/signup',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'registration'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// place order
			register_rest_route(
				$namespace,
				'/order-tasks',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'taskOrder'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// place order for project
			register_rest_route(
				$namespace,
				'/order-project',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'projectOrder'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//Amount after Escrow / amounts on activity
			register_rest_route(
				$namespace,
				'/activity-amounts',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'activityAmounts'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// place order
			register_rest_route(
				$namespace,
				'/user-balance',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getWalletBalance'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// place order
			register_rest_route(
				$namespace,
				'/add-wallet',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'updateWalletAmount'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Get profile
			register_rest_route(
				$namespace,
				'/get-profile',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getProfile'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Get profile
			register_rest_route(
				$namespace,
				'/get-verification',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getIdentityVerification'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Get invoice
			register_rest_route(
				$namespace,
				'/get-invoice',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getInvoice'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Get invoice
			register_rest_route(
				$namespace,
				'/remove-invoicepdf',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'removeInvoicePDF'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update proposal data
			register_rest_route(
				$namespace,
				'/update-proposal',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'updateProposal'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Get proposal
			register_rest_route(
				$namespace,
				'/get-proposal',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getProposal'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Get proposals
			register_rest_route(
				$namespace,
				'/get-proposals',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getProposals'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Get Projects
			register_rest_route(
				$namespace,
				'/get-projects',
				array(
					array(
						'methods' 	=> WP_REST_Server::READABLE,
						'callback' 	=> array(&$this, 'getProjects'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Complete project with/without review
			register_rest_route(
				$namespace,
				'/complete-project',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'completeProject'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update activities
			register_rest_route(
				$namespace,
				'/update-project-activities',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'UpdateProjectActivities'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Create Project Dispute
			register_rest_route(
				$namespace,
				'/create-project-dispute',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'CreateProjectDispute'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//reply on project refund dispute
			register_rest_route(
				$namespace,
				'/project-refund-dispute-reply',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'projectRefundDisputeReply'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// Update activities
			register_rest_route(
				$namespace,
				'/update-milestone-status',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'UpdateMilestoneStatus'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			// decline proposal
			register_rest_route(
				$namespace,
				'/decline-proposal',
				array(
					array(
						'methods' 	=> WP_REST_Server::CREATABLE,
						'callback' 	=> array(&$this, 'declineProposal'),
						'args' 		=> array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			/**
			 * Project posting module
			 */

			//Proposal price calculation details
			register_rest_route(
				$namespace,
				'/proposal-price-shares',
				array(
					array(
						'methods'     => WP_REST_Server::CREATABLE,
						'callback'     => array(&$this, 'proposalPriceShares'),
						'args'         => array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//Post job/Update job/project
			register_rest_route(
				$namespace,
				'/update-job',
				array(
					array(
						'methods'     => WP_REST_Server::CREATABLE,
						'callback'     => array(&$this, 'UpdateJob'),
						'args'         => array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//Recommended freelancers
			register_rest_route(
				$namespace,
				'/recommended-freelancers',
				array(
					array(
						'methods'     => WP_REST_Server::READABLE,
						'callback'     => array(&$this, 'recommendedFreelancers'),
						'args'         => array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//use template for project creation
			register_rest_route(
				$namespace,
				'/use-project-template',
				array(
					array(
						'methods'     => WP_REST_Server::CREATABLE,
						'callback'     => array(&$this, 'useProjectTemplate'),
						'args'         => array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//invite freelancer for bidding on project
			register_rest_route(
				$namespace,
				'/invite-to-bid-project',
				array(
					array(
						'methods'     => WP_REST_Server::CREATABLE,
						'callback'     => array(&$this, 'inviteToBidProject'),
						'args'         => array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//getting all tags list
			register_rest_route(
				$namespace,
				'/get-all-tags',
				array(
					array(
						'methods'     => WP_REST_Server::READABLE,
						'callback'     => array(&$this, 'getAllTags'),
						'args'         => array(),
						'permission_callback' => '__return_true',
					),
				)
			);

			//getting all user specific addons
			register_rest_route(
				$namespace,
				'/get-all-addons',
				array(
					array(
						'methods'     => WP_REST_Server::CREATABLE,
						'callback'     => array(&$this, 'getAllAddons'),
						'args'         => array(),
						'permission_callback' => '__return_true',
					),
				)
			);
		}

		/**
		 * Add/Update Project dispute
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function CreateProjectDispute($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id					= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id					= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$proposal_id				= !empty($request['proposal_id']) ? intval($request['proposal_id']) : 0;
			$request['dispute-details']	= !empty($request['dispute_details']) ? esc_html($request['dispute_details']) : '';
			$dispute_issue				= !empty($request['dispute_issue']) ? esc_html($request['dispute_issue']) : '';
			$response					= taskbotProjectDispute($user_id, $request, 'mobile');
			$response_status			= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;

			return new WP_REST_Response($response, $response_status);
		}

		/**
		 * project refund dispute replys
		 * 
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function projectRefundDisputeReply($request)
		{

			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$post_id					= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id					= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$dispute_id					= !empty($request['dispute_id']) ? intval($request['dispute_id']) : 0;
			$parent_comment_id			= !empty($request['parent_comment_id']) ? intval($request['parent_comment_id']) : 0;
			$dispute_comment			= !empty($request['dispute_comment']) ? esc_textarea($request['dispute_comment']) : '';
			$action_type				= !empty($request['action_type']) ? esc_textarea($request['action_type']) : '';

			if (empty($dispute_comment) || empty($action_type)) {
				$json['type'] 			= 'error';
				$json['message_desc'] 	= esc_html__('Something is missing', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			$response 					= taskbotProjectDisputeComments($user_id, $request, 'mobile');
			$response_status			= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;

			return new WP_REST_Response($response, $response_status);
		}


		/**
		 * Add/Update Milestone
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function updateMilestone($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id				= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id				= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$response				= taskbotAddMilestone($user_id, $request, 'mobile');
			$response_status		= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;

			return new WP_REST_Response($response, $response_status);
		}

		/**
		 * Update Milestone status
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function UpdateMilestoneStatus($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id				= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id				= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$response				= taskbotUpdateMilestoneStatus($user_id, $request, 'mobile');
			$response_status		= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;

			return new WP_REST_Response($response, $response_status);
		}

		/**
		 * Get projects that in working condition
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getProjects($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$profile_id				= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id				= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$type					= !empty($request['type']) ? esc_attr($request['type']) : '';
			$page_number			= !empty($request['page_number']) ? intval($request['page_number']) : 1;
			$per_page_itme			= !empty($request['show_posts']) ? intval($request['show_posts']) : 10;
			$sortby					= !empty($request['sortby']) ? esc_html($request['sortby']) : 'any';
			$keyword            	= !empty($request['keyword']) ? sanitize_text_field($request['keyword']) : "";

			$taskbot_args = array(
				'post_type'         => 'product',
				'post_status'       => 'any',
				'posts_per_page'    => $per_page_itme,
				'paged'             => $page_number,
				'author'            => $user_id,
				'orderby'           => 'meta_value_num',
				'meta_key'          => '_order_status',
				'order'             => 'DESC',
				'tax_query'         => array(
					array(
						'taxonomy' => 'product_type',
						'field'    => 'slug',
						'terms'    => 'projects',
					),
				),
			);
			if(!empty($sortby) && $sortby!= 'any' ){
				$update_status  = array('hired','cancelled','rejected','completed');
				if(in_array($sortby,$update_status) ){
					$taskbot_args['meta_query'] = array(
						array(
							'key'       => '_post_project_status',
							'value'     => $sortby,
							'compare'   => '=',
							'type'      => 'CHAR',
						)
					);
				} else {
					$taskbot_args['post_status'] = $sortby;
				}
			}

			$taskbot_query  = new WP_Query( apply_filters('taskbot_project_dashbaord_listings_args', $taskbot_args) );
			$count_post     = $taskbot_query->found_posts;

			$projects	= array();
			if ($taskbot_query->have_posts()) :
				while ($taskbot_query->have_posts()) : $taskbot_query->the_post();
					global $post;
					$list	= array();
					if (function_exists('taskbotProjectDetails')) {
						$list   = taskbotProjectDetails($post->ID, 'proposals', $user_id);
						$list['proposal_id']        = '';
						$list['porposal_edit']      = false;
						/* if current user already submitted proposal on this project */
						if (!empty($user_id)) {
							$proposal_args = array(
								'post_type'         => 'proposals',
								'post_status'       => 'any',
								'posts_per_page'    => -1,
								'author'            => $user_id,
								'meta_query'        => array(
									array(
										'key'       => 'project_id',
										'value'     => intval($post->ID),
										'compare'   => '=',
										'type'      => 'NUMERIC'
									)
								)
							);

							$proposals                  = get_posts($proposal_args);
							$taskbot_user_proposal      = !empty($proposals) && is_array($proposals) ? count($proposals) : 0;
							if (!empty($taskbot_user_proposal)) {
								$list['proposal_id']        = $proposals[0]->ID;
								$list['porposal_edit']      = true;
							}
						}
					}
					$projects[]		= $list;
				endwhile;
			endif;
			$json['type'] 			= 'success';
			$json['total_projects']	= $count_post;
			$json['project_data'] 	= $projects;
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Complete Project with/without review
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function completeProject($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$user_id	= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			if (!empty($user_id)) {
				$result = taskbotCompleteProposal($user_id, $request, 'mobile');
				return new WP_REST_Response($result, 200);
			} else {
				$json['type'] 			= 'error';
				$json['message_desc']   = esc_html__('User id is missing!', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}

		/**
		 * Get proposals
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getProposals($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$post_id				= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id				= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$type					= !empty($request['type']) ? esc_attr($request['type']) : '';
			$page_number			= !empty($request['page_number']) ? intval($request['page_number']) : 1;
			$per_page_itme			= !empty($request['show_posts']) ? intval($request['show_posts']) : 10;
			$sortby					= !empty($request['sortby']) ? esc_html($request['sortby']) : 'any';

			$taskbot_args = array(
				'post_type'         => 'proposals',
				'post_status'       => array('completed', 'refunded', 'pending', 'publish', 'draft', 'hired', 'disputed', 'rejected'),
				'posts_per_page'    => $per_page_itme,
				'paged'             => $page_number,
				'order'             => 'DESC'
			);
			if (!empty($sortby) && $sortby != 'any') {
				$taskbot_args['post_status'] = $sortby;
			}
			if (!empty($type) && $type === 'sellers' && !empty($user_id)) {
				$taskbot_args['author']		= $user_id;
				$taskbot_args['orderby']	= 'meta_value_num';
				$taskbot_args['meta_key']	= '_hired_status';
			}

			$taskbot_args['meta_query'] = array(
				array(
					'key'       => 'proposal_type',
					'value'     => 'fixed',
					'compare'   => '='
				)
			);
			$taskbot_query  = new WP_Query(apply_filters('taskbot_project_dashbaord_listings_args', $taskbot_args));
			$count_post     = $taskbot_query->found_posts;
			$proposal_details	= array();
			if ($taskbot_query->have_posts()) {
				while ($taskbot_query->have_posts()) {
					$taskbot_query->the_post();
					global $post;
					$proposal_details[]		= taskbotGetProposalBasic($post->ID, 'detail', $user_id);
				}
			}
			$json['type'] 			= 'success';
			$json['total_proposals'] = $count_post;
			$json['proposal_data'] 	= $proposal_details;
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Get proposal
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getProposal($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id				= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$proposal_id			= !empty($request['proposal_id']) ? intval($request['proposal_id']) : 0;
			$type					= !empty($request['type']) ? esc_attr($request['type']) : '';

			if (empty($proposal_id)) {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('You are not allowd to perfom this action', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			$proposal_details		= taskbotGetProposalBasic($proposal_id, $type);
			$json['type'] 			= 'success';
			$json['proposal_data'] 	= $proposal_details;
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Add project activity
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function UpdateProjectActivities($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$validation_fields  = array(
				'id'				=> esc_html__('Something went wrong please try again.', 'taskbot-api'),
				'activity_detail' 	=> esc_html__('Please add message to send.', 'taskbot-api')
			);
			$json               = array();
			$json['type']       = 'error';

			foreach ($validation_fields as $key => $validation_field) {
				if (empty($request[$key])) {
					$json['message_desc'] 		= $validation_field;
					return new WP_REST_Response($json, 203);
				}
			}

			$user_id			= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$commentdata		= taskbotProjectActivities($user_id, $request, 'mobile');
			$response_status	= !empty($commentdata['type']) && $commentdata['type'] === 'error' ? 203 : 200;
			return new WP_REST_Response($commentdata, $response_status);
		}


		/**
		 * Add/Update proposal
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function updateProposal($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$profile_id  	= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id     	= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$project_id     = !empty($request['project_id']) ? intval($request['project_id']) : 0;
			$proposal_id    = !empty($request['proposal_id']) ? intval($request['proposal_id']) : 0;
			$status         = !empty($request['status']) ? ($request['status']) : '';
			$proposal_data  = !empty($request['data']) ? $request['data'] : array();
			$response		= taskbotSubmitProposal($user_id, $project_id, $status, $proposal_data, $proposal_id, 'mobile');
			$response_status = !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
			return new WP_REST_Response($response, $response_status);
		}

		/**
		 * Get invoice
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getInvoice($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id				= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$order_id				= !empty($request['order_id']) ? intval($request['order_id']) : 0;
			$user_id				= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$user_type				= get_post_type($post_id);
			$invoice_detail			= TaskbotBuyerServicePDF($order_id, $user_id, $user_type);
			$json['type'] 			= 'success';
			$json['invoice_detail'] = $invoice_detail;
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Get invoice
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function removeInvoicePDF($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id				= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$file_path				= !empty($request['file_path']) ? ($request['file_path']) : '';
			wp_delete_file($file_path);
			$json['type'] 			= 'success';
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Get profile
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getProfile($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id				= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id				= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$user_type				= get_post_type($post_id);
			$profile_data			= taskbotGetProfile($post_id, $user_id, $user_type);
			$json['type'] 			= 'success';
			$json['profile_data'] 	= $profile_data;
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Get Identity Verification
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getIdentityVerification($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id							= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id							= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$identity_verified  	            = !empty($user_id) ? get_user_meta($user_id, 'identity_verified', true) : '';
			$json['identity_verified']      	= !empty($identity_verified) ? $identity_verified : '';
			$verification_attachments  	        = get_user_meta($user_id, 'verification_attachments', true);
			$verification_attachments	        = !empty($verification_attachments) ? $verification_attachments : array();
			$json['type'] 						= 'success';
			$json['verification_attachments'] 	= $verification_attachments;
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Get wallet
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getWalletBalance($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id			= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$user_balance   	= get_user_meta($user_id, '_buyer_balance', true);
			$user_balance   	= !empty($user_balance) ? $user_balance : 0;

			$json['type'] 					= 'success';
			$json['user_balance'] 			= esc_attr($user_balance);
			$json['user_balance_formate'] 	= taskbot_price_format($user_balance, 'return');

			return new WP_REST_Response($json, 200);
		}

		/**
		 * Update wallet amount
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function updateWalletAmount($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			global $taskbot_settings;
			$min_amount     	= !empty($taskbot_settings['min_wallet_amount']) ? $taskbot_settings['min_wallet_amount'] : 0;
			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$wallet_amount		= !empty($request['amount']) ? ($request['amount']) : 0;
			if (empty($wallet_amount)) {
				$json['type']         		= 'error';
				$json['message_desc'] 		= esc_html__('Please add amount', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			} else if ($wallet_amount < $min_amount) {
				$json['type']         		= 'error';
				$json['message_desc'] 		= sprintf(esc_html__('Please add minimum amount %s to add in your wallet', 'taskbot-api'), taskbot_price_format($min_amount, 'return'));
				return new WP_REST_Response($json, 203);
			}
			$user_id					= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$product_id                 = taskbot_buyer_wallet_create();
			$cart_meta                  = array();
			$cart_meta['wallet_id']     = $product_id;
			$cart_meta['user_id']     	= $user_id;
			$cart_meta['product_name']  = get_the_title($product_id);
			$cart_meta['price']         = $wallet_amount;
			$cart_meta['payment_type']  = 'wallet';
			$cart_data  = array(
				'wallet_id' => $product_id,
				'cart_data' => $cart_meta,
				'price'     => $wallet_amount,
				'payment_type'  => 'wallet'
			);
			update_post_meta($post_id, 'mobile_checkout_data', $cart_data);
			$mobile_checkout    = taskbot_get_page_uri('mobile_checkout');
			if (!empty($mobile_checkout)) {
				$json['checkout_url']	= $mobile_checkout . '?post_id=' . $post_id;
				$json['type'] 			= 'success';
				return new WP_REST_Response($json, 200);
			}
		}

		/**
		 * Project order
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function projectOrder($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$project_id			= !empty($request['project_id']) ? intval($request['project_id']) : 0;
			$wallet				= !empty($request['wallet']) ? sanitize_text_field($request['wallet']) : '';
			$key				= !empty($request['key']) ? sanitize_text_field($request['key']) : '';
			$proposal_id		= !empty($request['proposal_id']) ? intval($request['proposal_id']) : 0;
			$user_id			= !empty($project_id) ? get_post_field('post_author', $project_id) : 0;
			$response			= taskbotProjectHiring($user_id, $proposal_id, $wallet, $key, 'mobile');
			$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
			if (!empty($response_status) && $response_status == 200) {
				return new WP_REST_Response($response, 200);
			}
		}

		/**
		 * Amount after Escrow / after activity
		 * 
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function activityAmounts($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id			= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$proposal_id		= !empty($request['proposal_id']) ? intval($request['proposal_id']) : 0;

			if (!empty($proposal_id)) {
				$proposal_meta	    = get_post_meta($proposal_id, 'proposal_meta', true);
				$proposal_meta	    = !empty($proposal_meta) ? $proposal_meta : array();
				$proposal_type      = !empty($proposal_meta['proposal_type']) ? $proposal_meta['proposal_type'] : '';

				$wallet_amount   	= get_user_meta($user_id, '_buyer_balance', true);
				$wallet_amount   	= !empty($wallet_amount) ? $wallet_amount : 0;

				if (!empty($proposal_type) && $proposal_type === 'milestone') {
					$milestone              = !empty($proposal_meta['milestone']) ? $proposal_meta['milestone'] : array();
					$mileastone_array       = $completed_mil_array    = array();
					$hired_milestone        = $requested_milestone    = array();
					$taskbot_attr			= array();

					$hired_balance      = $earned_balance     = 0;
					$remaning_balance   = $milestone_total    = 0;
					if (!empty($milestone)) {
						foreach ($milestone as $key => $value) {
							$status = !empty($value['status']) ? $value['status'] : '';
							$price  = !empty($value['price']) ? $value['price'] : 0;
							$milestone_total    = $milestone_total  + $price;
							if (!empty($status) && $status === 'hired') {
								$hired_balance = $hired_balance + $price;
								$hired_milestone[$key] = $value;
							} else if (!empty($status) && $status === 'completed') {
								$earned_balance = $earned_balance + $price;
								$completed_mil_array[$key] = $value;
							} else if (!empty($status) && $status === 'requested') {
								$requested_milestone[$key] = $value;
								$hired_balance       = $hired_balance + $price;
							} else {
								$mileastone_array[$key] = $value;
								$remaning_balance       = $remaning_balance + $price;
							}
						}

						if (!empty($milestone_total) && $milestone_total == $earned_balance) {
							$taskbot_attr = array(
								'complete_option' => 'yes'
							);
						}
						$requested_milestone    = array_merge($requested_milestone, $hired_milestone);
						$mileastone_array       = array_merge($requested_milestone, $mileastone_array);

						$taskbot_attr = array(
							'wallet_amount'     	=> $wallet_amount,
							'earned_balance'     	=> $earned_balance,
							'hired_balance'       	=> $hired_balance,
							'remaning_balance'    	=> $remaning_balance,
							'project_budget'    	=> !empty($proposal_meta['price']) ? taskbot_price_format($proposal_meta['price'], 'return') : 0,
							'completed_mil_array'  	=> $completed_mil_array,
							'milestone_total'       => $milestone_total,
							'mileastone_array'     	=> $mileastone_array,
						);
					}
					return new WP_REST_Response($taskbot_attr, 200);
				} else if (empty($proposal_type) || (!empty($proposal_type) && $proposal_type === 'fixed')) {
					$taskbot_attr = array(
						'complete_option' => 'yes'
					);
					return new WP_REST_Response($taskbot_attr, 200);
				}
			} else {
				$json['message_desc']	= esc_html('Proposal id is missing', 'taskbot-api');
				$json['type'] 			= 'error';
				return new WP_REST_Response($json, 203);
			}
		}


		/**
		 * Task order
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function taskOrder($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id			= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$response			= taskbotOrderTasks($user_id, $request, 'mobile');
			$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;

			if (!empty($response_status) && $response_status == 200) {
				return new WP_REST_Response($response, 200);
			}
		}

		/**
		 * Registration
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function registration($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$json				= array();
			$response			= taskbotRegistration($request, 'mobile');
			$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
			if (!empty($response_status) && $response_status == 200) {
				$user_id				= !empty($response['user_id']) ? intval($response['user_id']) : 0;
				$user_type              = apply_filters('taskbot_get_user_type', $user_id);
				$profile_id             = apply_filters('taskbot_get_linked_profile_id', $user_id, '', $user_type);
				$authToken 				= $this->getTaskbotAuthToken($profile_id);

				if (function_exists('taskbot_get_user_basic')) {
					$userInfo	= taskbot_get_user_basic($profile_id, $user_id);
				}
				$settings		 		= taskbot_get_account_settings($user_type);
				if (!empty($settings)) {
					foreach ($settings as $key => $val) {
						$db_val 	= get_post_meta($profile_id, $key, true);
						$db_val 	= !empty($db_val) ?  $db_val : 'off';
						$userInfo['settings'][$key]	= $db_val;
					}
				}
				$userInfo['user_type']	= $user_type;
				$json['type']			= 'success';
				$json['userdetails'] 	= $userInfo;
				$json['authToken'] 		= $authToken;
				return new WP_REST_Response($json, 200);
			}
			return new WP_REST_Response($response, $response_status);
		}

		/**
		 * Get saved items
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getSavedItems($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$json				= array();
			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$type				= !empty($request['type']) ? ($request['type']) : '';
			$key    			= '_saved_tasks';
			if (!empty($type) && $type == 'tasks') {
				$key    = '_saved_tasks';
			} else if (!empty($type) && $type == 'sellers') {
				$key    = '_saved_sellers';
			} else if (!empty($type) && $type == 'projects') {
				$key    = '_saved_projects';
			}

			$saved_items    = get_post_meta($post_id, $key, true);
			$saved_items	= !empty($saved_items) ? $saved_items : array();
			$json['items']	= maybe_unserialize($saved_items);
			return new WP_REST_Response($json, 203);
		}

		/**
		 * Switch user
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function switchUser($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$json				= array();
			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id			= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$response			= taskbotSwitchUser($user_id, 'mobile');
			$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
			if (!empty($response_status) && $response_status == 200) {
				$user_type              = apply_filters('taskbot_get_user_type', $user_id);
				$profile_id             = apply_filters('taskbot_get_linked_profile_id', $user_id, '', $user_type);
				$authToken 				= $this->getTaskbotAuthToken($profile_id);

				if (function_exists('taskbot_get_user_basic')) {
					$userInfo	= taskbot_get_user_basic($profile_id, $user_id);
				}
				$settings		 		= taskbot_get_account_settings($user_type);
				if (!empty($settings)) {
					foreach ($settings as $key => $val) {
						$db_val 	= get_post_meta($profile_id, $key, true);
						$db_val 	= !empty($db_val) ?  $db_val : 'off';
						$userInfo['settings'][$key]	= $db_val;
					}
				}
				$userInfo['user_type']	= $user_type;
				$json['type']			= 'success';
				$json['userdetails'] 	= $userInfo;
				$json['authToken'] 		= $authToken;
				return new WP_REST_Response($json, 200);
			} else {
				return new WP_REST_Response($response, 203);
			}
		}
		/**
		 * Upload profile image
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function uploadAvatar($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$json				= array();
			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$profile_image 		= $_FILES['profile_image'];
			if (empty($profile_image)) {
				$json['type'] 		    = 'error';
				$json['message_desc'] 		= esc_html('Please upload the profile image', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			} else {
				require_once(ABSPATH . 'wp-admin/includes/file.php');
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				require_once(ABSPATH . 'wp-includes/pluggable.php');
				$uploaded_image  	= wp_handle_upload($profile_image, array('test_form' => false));
				$file_name		 	= basename($profile_image['name']);
				$file_type 		 	= wp_check_filetype($uploaded_image['file']);

				// Prepare an array of post data for the attachment.
				$attachment_details = array(
					'guid' 				=> $uploaded_image['url'],
					'post_mime_type' 	=> $file_type['type'],
					'post_title' 		=> preg_replace('/\.[^.]+$/', '', basename($file_name)),
					'post_content' 		=> '',
					'post_status' 		=> 'inherit'
				);

				$attach_id 		= wp_insert_attachment($attachment_details, $uploaded_image['file']);
				$attach_data 	= wp_generate_attachment_metadata($attach_id, $uploaded_image['file']);
				wp_update_attachment_metadata($attach_id, $attach_data);
				$pre_attachment_id  = get_post_thumbnail_id($post_id);
				if (!empty($pre_attachment_id)) {
					wp_delete_attachment($pre_attachment_id, true);
				}
				set_post_thumbnail($post_id, $attach_id);
				$avatar                         = apply_filters('taskbot_avatar_fallback', taskbot_get_user_avatar(array('width' => 315, 'height' => 300), $post_id), array('width' => 315, 'height' => 300));
				$json['type'] 		= 'success';
				$json['avatar'] 	= esc_url($avatar);
				$json['message_desc'] 	= esc_html__('Successfully! update profile image', 'taskbot-api');

				return new WP_REST_Response($json, 200);
			}
		}

		/**
		 * Get password
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function forgetPassword($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$user_email 		= !empty($request['email']) ? sanitize_email($request['email']) : '';
			$response			= taskbotForgetPassword($user_email, 'mobile');
			$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
			return new WP_REST_Response($response, $response_status);
		}

		/**
		 * Get payout list
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function updateSavedItems($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id			= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$request['post_id']	= !empty($request['item_id']) ? intval($request['item_id']) : 0;
			$response			= taskbotUpdateSavedItems($user_id, $request, 'mobile');
			$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
			return new WP_REST_Response($response, $response_status);
		}

		/**
		 * Get payout list
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function fundRequest($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id			= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$response			= taskbotWithdraqRequest($user_id, $request, 'mobile');
			$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
			return new WP_REST_Response($response, $response_status);
		}

		/**
		 * Get payout list
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function get_payout($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id		= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id		= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$query_args   	= array();
			$post_status  	= array('pending', 'publish');
			$withdraw_id  	= (!empty($request['withdraw_id']) ? intval($request['withdraw_id']) : "");
			$sort_by_status = (!empty($request['sort_by']) ? esc_html($request['sort_by']) : "");
			$payrols		= taskbot_get_payouts_lists();
			if (!empty($withdraw_id)) {
				$filtered_args['post_in'] = array(
					'post__in' => array($withdraw_id),
				);

				$query_args = array_merge($query_args, $filtered_args['post_in']);
			}

			// if sort by status exists, then update the $post_status array
			if (!empty($sort_by_status)) {
				$post_status    = array($sort_by_status);
			}

			// standard $query_args as $withdraw_args
			$page_number	= !empty($request['page_number']) ? intval($request['page_number']) : 1;
			$per_page_itme	= !empty($request['per_page_itme']) ? intval($request['per_page_itme']) : 10;
			$withdraw_args  = array(
				'post_type'       => 'withdraw',
				'author'          => $user_id,
				'post_status'     => $post_status,
				'posts_per_page'  => $per_page_itme,
				'paged'           => $page_number,
			);

			$withdraw_args 		= array_merge_recursive($withdraw_args, $query_args);
			$withdraw_query     = new WP_Query(apply_filters('taskbot_withdraw_listings_args', $withdraw_args));
			$count_post 		= $withdraw_query->found_posts;
			$payout_list		= array();
			if ($withdraw_query->have_posts()) :
				while ($withdraw_query->have_posts()) : $withdraw_query->the_post();
					$payout		  = array();
					$post_id      = get_the_ID();
					$date 		  = get_the_date();
					$status       = get_post_status($post_id);
					if (!empty($status) && $status === 'publish') {
						$status_text = esc_attr__('Approved', 'taskbot-api');
					} else {
						$status_text = ucfirst($status);
					}
					$post_date    = !empty($date) ? date_i18n('F j, Y', strtotime($date)) : '';
					$post_date    = date_i18n(get_option('date_format'),  strtotime(get_the_date()));

					$withdraw_amount  	= !empty(get_post_meta($post_id, '_withdraw_amount', true)) ? get_post_meta($post_id, '_withdraw_amount', true) : '';
					$payment_method   	= !empty(get_post_meta($post_id, '_payment_method', true))  ? get_post_meta($post_id, '_payment_method', true)  : '';
					$unique_key       	= !empty(get_post_meta($post_id, '_unique_key', true))      ? get_post_meta($post_id, '_unique_key', true)      : '';
					$payment_method		= !empty($payrols[$payment_method]['label']) ? $payrols[$payment_method]['label'] : $payment_method;

					$payout['status']			= !empty($status_text) ? $status_text : '';
					$payout['unique_key']		= !empty($unique_key) ? $unique_key : '';
					$payout['post_date']		= !empty($post_date) ? $post_date : '';
					$payout['payment_method']	= !empty($payment_method) ? $payment_method : '';
					$payout['withdraw_amount']	= isset($withdraw_amount) ? taskbot_price_format($withdraw_amount, 'return') : 0;
					$payout_list[]				= $payout;
				endwhile;
				wp_reset_postdata();
			endif;

			$json['type'] 		= 'success';
			$json['payout'] 	= $payout_list;
			return new WP_REST_Response($json, 200);
		}

		/**
		 * @init            Site demo content
		 * @package         Amentotech
		 * @subpackage      taskbot/includes
		 * @since           1.0
		 * @desc            Display The Tab System URL
		 */
		public function taskbot_is_mobile_demo_site()
		{
			$json 		= array();
			if (
				isset($_SERVER["SERVER_NAME"])
				&& $_SERVER["SERVER_NAME"] === 'amentotech.com'
			) {
				$json['type']	    		= "error";
				$json['message_desc'] 		= esc_html__("Sorry! you are restricted to perform this action on demo site.", 'taskbot-api');
				return $json;
			}
		}
		/**
		 * Update payout settings
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function update_payout_setting($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$json			= array();
			$post_id		= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id		= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$data 			= array();
			$payout_list = taskbot_get_payouts_lists();
			// $fields = !empty($payout_list[$_POST['payout_settings']['type']]['fields']) ? $payout_list[$_POST['payout_settings']['type']]['fields'] : array();

			/* creating associative array */
			$payout_setings     = !empty($request['payout_settings']) ? $request['payout_settings'] : array();
			$payout_method_arr  = get_user_meta($user_id, 'taskbot_payout_method', true);
			$payout_method_arr  = !empty($payout_method_arr) ? $payout_method_arr : array();
			if (!empty($payout_setings)) {
				foreach ($payout_setings as $type_key => $val) {
					$fields = !empty($payout_list[$type_key]['fields']) ? $payout_list[$type_key]['fields'] : array();
					if (!empty($fields)) {
						foreach ($fields as $key => $field) {

							if ($field['required'] === true && empty($payout_setings[$type_key][$key])) {
								$json['type']         = 'error';
								$json['message_desc'] = $field['message'];
								return new WP_REST_Response($json, 203);
							}
						}
					}
					$payout_method_arr[$type_key] = $val;
				}
			}
			update_user_meta($user_id, 'taskbot_payout_method', $payout_method_arr);
			$json['type'] 	 		= 'success';
			$json['message_desc'] 	= esc_html__('Payout settings updated', 'taskbot_api');
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Get payout settings
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function get_payout_setting($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id	= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id	= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$payrols	= array();
			if (function_exists('taskbot_get_payouts_lists')) {
				$payrols		= taskbot_get_payouts_lists();
			}

			$contents	= get_user_meta($user_id, 'taskbot_payout_method', true);

			$json						= array();
			$json['payout_settings']	= $payrols;
			$json['saved_settings']		= $contents;


			$json['type'] 		= 'success';
			$json['message_desc'] 	= esc_html__('Payout settings', 'taskbot_api');
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Get sellers all balnces
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function get_balance($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id	= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id	= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;

			$json	= array();
			$list 	= array(
				'post_id'   => esc_html__('You are not allowed to perform this action', 'taskbot-api'),
			);
			foreach ($list as $meta_key => $value) {
				if (empty($request[$meta_key])) {
					$json['type'] 		    = 'error';
					$json['message_desc'] 	= esc_html($value);
					return new WP_REST_Response($json, 203);
				}
			}

			$linked_profile	= taskbot_get_linked_profile_id($user_id);
			$user_type      = taskbot_get_profile_type($linked_profile);

			if (!empty($user_type) && $user_type === 'sellers') {

				$total_amount           = taskbot_account_details($user_id, array('wc-completed'), 'completed');
				$pending_blance         = taskbot_account_details($user_id, array('wc-completed'), 'hired');
				$withdraw_amount        = taskbot_account_withdraw_details($user_id, array('pending', 'publish'));
				$available_in_amount    = $total_amount - $withdraw_amount;

				$total_amount           = !empty($total_amount) ? number_format($total_amount, 2) : 0;
				$withdraw_amount        = !empty($withdraw_amount) ? number_format($withdraw_amount, 2) : 0;
				$pending_blance         = !empty($pending_blance) ? number_format($pending_blance, 2) : 0;
				$available_in_amount    = !empty($available_in_amount) ? number_format($available_in_amount, 2) : 0;

				$balance = array(
					'total_amount'          => $total_amount,
					'withdraw_amount'       => $withdraw_amount,
					'pending_blance'        => $pending_blance,
					'available_in_amount'   => $available_in_amount,
				);

				$json['type']           		= 'success';
				$json['account_detail']   		= $balance;
				return new WP_REST_Response($json, 200);
			} else {
				$json['type']           = 'error';
				$json['message_desc']   =  esc_html__('your are not allow to perform this action', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}

		/**
		 * Task cancelled
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function taskCancelled($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$json				= array();
			$validation_fields  = array(
				'task_id'   => esc_html__('You are not allowed to perform this action', 'taskbot-api'),
				'order_id'  => esc_html__('You are not allowed to perform this action', 'taskbot-api'),
				'details'   => esc_html__('You need to cancellation reason', 'taskbot-api')
			);

			foreach ($validation_fields as $key => $validation_field) {
				if (empty($request[$key])) {
					$json['message_desc'] 		= $validation_field;
					return new WP_REST_Response($json, 203);
				}
			}
			$task_id        = !empty($request['task_id']) ? intval($request['task_id']) : 0;
			$user_id        = !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$order_id       = !empty($request['order_id']) ? intval($request['order_id']) : 0;
			$details        = !empty($request['details']) ? sanitize_textarea_field($request['details']) : '';
			$post_author    = get_post_meta($order_id, 'buyer_id', true);

			if ($post_author != $user_id) {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('You are not allowed to perform this action', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			foreach ($validation_fields as $key => $validation_field) {

				if (empty($request[$key])) {
					$json['type']               = 'error';
					$json['message_desc'] 		= $validation_field;
					return new WP_REST_Response($json, 203);
				}
			}

			if (empty($post_author) || $post_author != $user_id) {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('You are not allowed to perform this action', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			$post_id		= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id		= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$user_type		= get_post_type($post_id);

			if (!empty($user_type) && $user_type === 'buyers') {
				$response			= taskbotCancelledTask($user_id, $request, 'mobile');
				$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
				return new WP_REST_Response($response, $response_status);
			}
		}

		/**
		 * Create task
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function create_task($request)
		{
			global $taskbot_settings;

			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$type           = !empty($request['type']) ?  $request['type'] : 'add';
			$post_id        = !empty($request['task_id']) ?  intval($request['task_id']) : 0;
			$user_id        = !empty($request['user_id']) ?  intval($request['user_id']) : 0;
			$profile_id   	= !empty($request['post_id']) ?  intval($request['post_id']) : 0; /* profile id */
			$action   		= !empty($request['action']) ?  $request['action'] : '';

			if (empty($user_id)) {
				$json['type']           = 'error';
				$json['message']        = esc_html__('Restricted Access', 'taskbot-api');
				$json['message_desc']   = esc_html__('You are not allowed to perform this action.', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			if (!empty($action) && $action === 'taskbot_add_service_inroduction_save') {

				$default_attribs = array(
					'id' 		=> array(),
					'class' 	=> array(),
					'title' 	=> array(),
					'style' 	=> array(),
					'data' 		=> array(),
				);

				$allowed_tags   = array(
					'a' => array_merge($default_attribs, array(
						'href' 		=> array(),
						'title' 	=> array()
					)),
					'br'        	=> array(),
					'h1'        	=> array(),
					'h2'        	=> array(),
					'h3'        	=> array(),
					'h4'        	=> array(),
					'h5'        	=> array(),
					'h6'        	=> array(),
					'em'        	=> array(),
					'strong'    	=> array(),
					'u'             => $default_attribs,
					'i'             => $default_attribs,
					'q'             => $default_attribs,
					'b'             => $default_attribs,
					'ul'            => $default_attribs,
					'ol'            => $default_attribs,
					'li'            => $default_attribs,
					'br'            => $default_attribs,
					'hr'            => $default_attribs,
					'strong'        => $default_attribs,
					'blockquote'    => $default_attribs,
					'del'           => $default_attribs,
					'strike'        => $default_attribs,
					'em'            => $default_attribs,
					'code'          => $default_attribs,
				);

				$post_data      = !empty($request['taskbot_service']) ? $request['taskbot_service'] : array();
				$post_title     = !empty($post_data['post_title']) ? sanitize_text_field($post_data['post_title']) : '';
				$post_content   = !empty($post_data['post_content']) ? wp_kses($post_data['post_content'], $allowed_tags) : '';
				$locations      = $categories = $post_tags = $languages = array();

				$taxonomy_category_data     = !empty($post_data['category']) ? intval($post_data['category']) : '';
				$category_level2            = !empty($post_data['category_level2']) ? intval($post_data['category_level2']) : '';
				$category_level3            = !empty($post_data['category_level3']) ? $post_data['category_level3'] : array();
				$taxonomy_product_tag_data  = !empty($post_data['product_tag']) ? $post_data['product_tag'] : '';
				$taxonomy_locations_data    = !empty($post_data['locations']) ? sanitize_text_field($post_data['locations']) : '';
				$zipcode 	                = !empty($post_data['zipcode']) ? sanitize_text_field($post_data['zipcode']) : '';

				$validation_fields  = array(
					'post_title'    => esc_html__('Please enter task title.', 'taskbot-api'),
					'category'   	=> esc_html__('Please select task category.', 'taskbot-api')
				);

				foreach ($validation_fields as $key => $validation_field) {

					if (empty($post_data[$key])) {
						$json['type']           = 'error';
						$json['message_desc']   = $validation_field;
						return new WP_REST_Response($json, 203);
					}
				}

				$parent_category = $subcategory = $service_type = $categories_term = array();

				if ($taxonomy_category_data) {
					$categories_term[]                  = $taxonomy_category_data;
					$category                           = get_term_by('id', $taxonomy_category_data, 'product_cat');
					$categories[$category->slug]        = $category->name;
					$parent_category[$category->slug]   = $category->name;
				}

				if ($category_level2) {
					$category                           = get_term_by('id', $category_level2, 'product_cat');
					$categories[$category->slug]        = $category->name;
					$subcategory[$category->slug]       = $category->name;
					$categories_term[]                  = $category_level2;
				}

				if (!empty($category_level3) && is_array($category_level3)) {
					foreach ($category_level3 as $term_id) {

						if ($term_id) {
							$term_id    = intval($term_id);
							$category   = get_term_by('id', $term_id, 'product_cat');
							$categories[$category->slug]        = $category->name;
							$service_type[$category->slug]      = $category->name;
							$categories_term[]                  = $term_id;
						}
					}
				}

				$tb_product_tags = array();
				$taxonomy_product_tag_data  = stripslashes($taxonomy_product_tag_data['0']);
				$taxonomy_product_tag_data  = json_decode($taxonomy_product_tag_data);
				if (!empty($taxonomy_product_tag_data)) {
					foreach ($taxonomy_product_tag_data as $product_tag) {

						if (!empty($product_tag->value)) {
							$tb_product_tags[]  = $product_tag->value;
						}
					}
				}

				$old_zipcode = $old_location = '';
				if ($post_id) {
					$product_data   = get_post_meta($post_id, 'tb_service_meta', true);
					$product_data   = !empty($product_data) ? $product_data : array();
					$old_zipcode    = get_post_meta($post_id, 'zipcode', true);
					$old_country    = get_post_meta($post_id, '_country', true);
					$old_location   = get_post_meta($post_id, 'location', true);
				}

				if (empty($taskbot_settings['enable_zipcode'])) {
					$product_data['country']        = $taxonomy_locations_data;
				} else if ((!empty($old_zipcode) && $old_zipcode != $zipcode && $old_country != $taxonomy_locations_data) || empty($old_zipcode)) {
					$response   = array();
					$response   = taskbot_process_geocode_info($zipcode, $taxonomy_locations_data, 'mobile');
					if (!empty($response['type']) && $response['type'] == 'error') {
						return new WP_REST_Response($response, 203);
					} else {
						$response   = !empty($response['geo_data']) ? $response['geo_data'] : array();
					}

					if (!empty($response)) {
						$product_data['country']        = $taxonomy_locations_data;
						$product_data['latitude']       = $response['lat'];
						$product_data['longitude']      = $response['lng'];
						$product_data['zipcode']        = $zipcode;
					}
				}

				$product_data['categories']     = $categories;
				$product_data['category']       = $parent_category;
				$product_data['subcategory']    = $subcategory;
				$product_data['service_type']   = $service_type;
				$product_data['product_tag']    = $post_tags;

				// Update post
				$tb_post_data = array(
					'post_title' 	=> wp_strip_all_tags($post_title),
					'post_content' 	=> $post_content,
					'post_type'    	=> 'product',
					'post_author'  	=> $user_id,
					'meta_input'   	=> array(
						'tb_service_meta' => $product_data,
					),
				);

				if ($post_id) {
					// Update the post into the database
					$tb_post_data['ID']         = $post_id;
					$tb_post_data['post_name']  = sanitize_title($post_title);
					wp_update_post($tb_post_data);
				} else {
					$tb_post_data['post_status'] = 'draft';
					// insert the post into the database
					$post_id = wp_insert_post($tb_post_data);
				}

				if (empty($taskbot_settings['enable_zipcode'])) {
					update_post_meta($post_id, 'zipcode', 0);
					update_post_meta($post_id, 'longitude', 0);
					update_post_meta($post_id, 'latitude', 0);
				} else if ((!empty($old_zipcode) && $old_zipcode != $zipcode && $old_country != $taxonomy_locations_data) || empty($old_zipcode)) {
					if (!empty($response)) {
						update_post_meta($post_id, 'location', $response);
						update_post_meta($post_id, 'zipcode', $zipcode);
						update_post_meta($post_id, 'longitude', $response['lng']);
						update_post_meta($post_id, 'latitude', $response['lat']);
					}
				}
				
				if ($post_id) {
					taskbotUpdateStatus($post_id);
					update_post_meta($post_id, 'tb_product_type', 'tasks');

					update_post_meta($post_id, '_country', $taxonomy_locations_data);
					wp_set_object_terms($post_id, $tb_product_tags, 'product_tag');
					wp_set_post_terms($post_id, $categories_term, 'product_cat');
					wp_set_object_terms($post_id, 'tasks', 'product_type', true);
					do_action('taskbot_task_create_activity', $post_id, $post_data);

					$json['type']               = 'success';
					$json['task_id']            = (int)$post_id;
					$json['step']               = 2;
					$json['message'] 		    = esc_html__('Woohoo!', 'taskbot-api');
					$json['message_desc'] 		= esc_html__('Task has been updated', 'taskbot-api');
					return new WP_REST_Response($json, 200);
				} else {
					$json['type']               = 'error';
					$json['message'] 		    = esc_html__('Oops', 'taskbot-api');
					$json['message_desc'] 		= esc_html__('There is an error occur, please try again later', 'taskbot-api');
					return new WP_REST_Response($json, 203);
				}
			} else if (!empty($request['action']) && $request['action'] == 2) {
				$custom_field_option    =  !empty($taskbot_settings['custom_field_option']) ? $taskbot_settings['custom_field_option'] : false;
				$maxnumber_fields       =  !empty($taskbot_settings['maxnumber_fields']) ? $taskbot_settings['maxnumber_fields'] : 5;
				if (!empty($post_id)) {
					$taskbot_plans          = !empty($request['plans']) ? wp_unslash($request['plans']) : array();
					$featured_package       = !empty($request['featured_package']) ? $request['featured_package'] : '';
					$custom_fields          = !empty($request['custom_fields']) ? $request['custom_fields'] : array();
					$subtasks_ids           = !empty($request['subtasks_selected_ids']) ? $request['subtasks_selected_ids'] : array();

					if (!empty($custom_field_option)) {
						$custom_field_array = array();
						if (!empty($custom_fields)) {
							if (!empty($maxnumber_fields) && !empty($custom_fields) && is_array($custom_fields) && count($custom_fields) >= $maxnumber_fields) {
								$json['type']           = 'error';
								$json['message']        = esc_html__('Uh-Oh!', 'taskbot-api');
								$json['message_desc'] 	= sprintf(esc_html__('You are allowed to add only %s custom fields', 'taskbot-api'), $maxnumber_fields);
								return new WP_REST_Response($json, 203);
							}

							foreach ($custom_fields as $key => $custom_field) {
								$custom_field_array[]   = $custom_field;
								if (empty($custom_field['title'])) {
									$json['type']           = 'error';
									$json['message']        = esc_html__('Uh-Oh!', 'taskbot-api');
									$json['message_desc'] 	= esc_html__("Please don't leave empty custom fields. Either remove this or add the field title", 'taskbot-api');
									return new WP_REST_Response($json, 203);
								}
							}
						}

						update_post_meta($post_id, 'tb_custom_fields', $custom_field_array);
					}

					$this->task_allowed         = taskbot_task_create_allowed($user_id);
					$this->package_detail       = taskbot_get_package($user_id);
					$subtasks_ids               = !empty($subtasks_ids) ? explode(',', $subtasks_ids) : array();
					$subtasks_ids               = !empty($subtasks_ids) ? array_map('absint', $subtasks_ids) : array();
					$taskbot_plans              = taskbot_recursive_sanitize_text_field($taskbot_plans);
					$this->task_plans_allowed   = 'yes';
					$package_type               =  !empty($this->package_detail['type']) ? $this->package_detail['type'] : '';
					$delivwery_defult_pkg       = 'basic';
					if ($package_type == 'paid') {
						$this->task_plans_allowed       =  !empty($this->package_detail['package']['task_plans_allowed']) ? $this->package_detail['package']['task_plans_allowed'] : 'no';
						$this->number_tasks_allowed     =  !empty($this->package_detail['package']['number_tasks_allowed']) ? $this->package_detail['package']['number_tasks_allowed'] : 0;
					}

					if ($this->task_plans_allowed == 'no') {
						$task_plans = array();
						foreach ($taskbot_plans as $key => $plan_pkgs) {
							$task_plans[$key]   = $plan_pkgs;
							$min_price          = $plan_pkgs['price'];
							$max_price          = $plan_pkgs['price'];
							break;
						}
						$taskbot_plans = $task_plans;
					} else {
						$task_plans = array();
						$min_price  = 0;
						$max_price  = 0;
						foreach ($taskbot_plans as $key => $plan_pkgs) {

							if (!empty($plan_pkgs['title']) && !empty($plan_pkgs['price'])) {
								$task_plans[$key]   = $plan_pkgs;
								if (!empty($featured_package) && $featured_package === $key) {
									$task_plans[$key]['featured_package'] = 'yes';
									$delivwery_defult_pkg   = $key;
								} else {
									$task_plans[$key]['featured_package'] = 'no';
								}

								if (empty($min_price) || ($min_price > $plan_pkgs['price'])) {
									$min_price	= $plan_pkgs['price'];
								}

								if (empty($max_price) || ($max_price < $plan_pkgs['price'])) {
									$max_price	= $plan_pkgs['price'];
								}
							}
						}
						$taskbot_plans = $task_plans;
					}

					if (isset($taskbot_plans['basic']['price'])) {
						update_post_meta($post_id, '_regular_price', floatval($taskbot_plans['basic']['price']));
						update_post_meta($post_id, '_price', floatval($taskbot_plans['basic']['price']));
					}

					update_post_meta($post_id, '_min_price', floatval($min_price));
					update_post_meta($post_id, '_max_price', floatval($max_price));

					if (!empty($featured_package)) {
						update_post_meta($post_id, '_featured_package', $featured_package);
					}

					$duration = array_map(function ($ar) {
						return $ar['delivery_time'];
					}, $taskbot_plans);

					wp_set_post_terms($post_id, $duration, 'delivery_time');

					if (isset($taskbot_plans[$delivwery_defult_pkg]['delivery_time'])) {
						update_post_meta($post_id, '_delivery_time', intval($taskbot_plans[$delivwery_defult_pkg]['delivery_time']));
					}

					if (isset($request['plans'])) {
						update_post_meta($post_id, 'taskbot_product_plans', $taskbot_plans);
					}

					if (isset($request['subtasks_selected_ids'])) {
						update_post_meta($post_id, 'taskbot_product_subtasks', $subtasks_ids);
					}

					do_action('taskbot_add_service_plans_save_activity', $post_id, $request);
					taskbotUpdateStatus($post_id);
					$json['type']               = 'success';
					$json['task_id']            = (int)$post_id;
					$json['step']               = 3;
					$json['message'] 		    = esc_html__('Woohoo!', 'taskbot-api');
					$json['message_desc'] 		= esc_html__('Task has been updated', 'taskbot-api');
					return new WP_REST_Response($json, 200);
				} else {
					$json['type']               = 'error';
					$json['message'] 		    = esc_html__('Oops', 'taskbot-api');
					$json['message_desc'] 		= esc_html__('There is an error occur, please try again later', 'taskbot-api');
					return new WP_REST_Response($json, 203);
				}
			} else if (!empty($request['action']) && $request['action'] == 3) {
				$data	= $request;
				require_once(ABSPATH . 'wp-admin/includes/file.php');
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				require_once(ABSPATH . 'wp-includes/pluggable.php');
				require_once(ABSPATH . 'wp-admin/includes/media.php');
				/**
				 * Gallery Images
				 */
				$total_new_gallery_images 	= !empty($request['new_gallery_images']) ? $request['new_gallery_images'] : 0;
				$old_gallery_images			= !empty($request['old_gallery_images']) ? json_decode(stripslashes($request['old_gallery_images']), true) : array();

				$attachment_ids = array();
				if (!empty($_FILES) && $total_new_gallery_images > 0) {

					/* already attached images array from api's */
					$old_attachments = !empty($old_gallery_images) ? $old_gallery_images : array();

					/* attached gallery images from DB */
					$db_gallery_attachment_arr 		= get_post_meta($post_id, '_product_attachments', true);
					$db_gallery_attachment_arr		= !empty($db_gallery_attachment_arr) ? $db_gallery_attachment_arr : array();

					/* create array of gallery attachment id's that srote in DB */
					$db_gallery_attachment = array();
					if (!empty($db_gallery_attachment_arr)) {
						$db_gallery_attachment 	= wp_list_pluck($db_gallery_attachment_arr, 'attachment_id');
					}

					/* delete all images if empty array received from api's */
					if (empty($old_attachments) && !empty($db_gallery_attachment)) {
						foreach ($db_gallery_attachment as $delete_media) {
							if (!empty($delete_media)) {
								wp_delete_attachment($post_id, $delete_media, true);
							}
						}
						delete_post_meta($post_id, '_product_image_gallery');
						delete_post_meta($post_id, '_product_attachments');
					}

					/* upload new docs if exist */
					$newyUploadGallery = array();
					if (!empty($total_new_gallery_images) && $total_new_gallery_images > 0) {
						/* count saved data form db for indexing */
						$new_index	= !empty($db_gallery_attachment_arr) ?  max(array_keys($db_gallery_attachment_arr)) : 0;
						for ($x = 0; $x < $total_new_gallery_images; $x++) {
							$new_index 				= $new_index + 1;
							$gallery_image_files 	= $_FILES['gallery_image' . $x];

							$uploaded_image  		= wp_handle_upload($gallery_image_files, array('test_form' => false));
							$file_name			 	= basename($gallery_image_files['name']);
							$file_type 		 		= wp_check_filetype($uploaded_image['file']);

							/* Prepare an array of post data for the attachment. */
							$attachment_details = array(
								'guid' 				=> $uploaded_image['url'],
								'post_mime_type' 	=> $file_type['type'],
								'post_title' 		=> preg_replace('/\.[^.]+$/', '', basename($file_name)),
								'post_content' 		=> '',
								'post_status' 		=> 'inherit'
							);

							$attach_id 		= wp_insert_attachment($attachment_details, $uploaded_image['file']);
							$attach_data 	= wp_generate_attachment_metadata($attach_id, $uploaded_image['file']);
							wp_update_attachment_metadata($attach_id, $attach_data);

							$documents['attachment_id']		= $attach_id;
							$documents['name']				= get_the_title($attach_id);
							$documents['url']				= wp_get_attachment_url($attach_id);
							$documents['size']              = filesize(get_attached_file($attach_id));
							$newyUploadGallery[]			= $documents;
							$attachment_ids[]               = $attach_id;
						}
					}

					/* set post thumbnail */
					if (is_array($attachment_ids) && !empty($attachment_ids[0])) {
						set_post_thumbnail($post_id, $attachment_ids[0]);
					}

					/* delete some images that not send in request */
					if (!empty($old_attachments) && !empty($db_gallery_attachment)) {
						$updateGalleryArr = $newAttachment_ids = array();
						$db_saved_gallery = !empty($db_gallery_attachment_arr) ? $db_gallery_attachment_arr : array();

						if (!empty($db_saved_gallery) && !empty($old_attachments)) {
							foreach ($db_saved_gallery as $galleryVal) {
								foreach ($old_attachments as $oldAttachmentVal) {
									if ($galleryVal['attachment_id'] == $oldAttachmentVal['attachment_id']) {
										$updateGalleryArr[] = array(
											'attachment_id' => (int)$galleryVal['attachment_id'],
											'url' 			=> $galleryVal['url'],
											'name'			=> 	get_the_title((int)$galleryVal['attachment_id'])
										);
										$newAttachment_ids[] = (int)$galleryVal['attachment_id'];
									}
								}
							}
						}
						$galleryNew_arr = array_merge($newyUploadGallery, $updateGalleryArr);
						update_post_meta($post_id, '_product_attachments', $galleryNew_arr);

						/* only new and old attachment ids save as string */
						$galleryIds_arr = array_merge($attachment_ids, $newAttachment_ids);
						$attachment_ids_string  = implode(',', $galleryIds_arr);
						update_post_meta($post_id, '_product_image_gallery', $attachment_ids_string);
					} else {
						/* if image upload first time */
						update_post_meta($post_id, '_product_attachments', $newyUploadGallery);

						$attachment_ids_string  = implode(',', $attachment_ids);
						update_post_meta($post_id, '_product_image_gallery', $attachment_ids_string);
					}
				} else {
					/* already attached images array from api's */
					$old_attachments = !empty($old_gallery_images) ? $old_gallery_images : array();

					/* attached gallery images from DB */
					$db_gallery_attachment_arr       = get_post_meta($post_id, '_product_attachments', true);
					$db_gallery_attachment_arr		= !empty($db_gallery_attachment_arr) ? $db_gallery_attachment_arr : array();

					/* create array of attachment id's that srote in DB */
					$db_gallery_attachment = array();
					if (!empty($db_gallery_attachment_arr)) {
						$db_gallery_attachment 	= wp_list_pluck($db_gallery_attachment_arr, 'attachment_id');
					}

					/* delete all images if empty array received from api's */
					if (empty($old_attachments) && !empty($db_gallery_attachment)) {
						foreach ($db_gallery_attachment as $delete_media) {
							if (!empty($delete_media)) {
								wp_delete_attachment($post_id, $delete_media, true);
							}
						}
						delete_post_meta($post_id, '_product_image_gallery');
						delete_post_meta($post_id, '_product_attachments');
					} else {
						$newGalleryArr = $newAttachment_ids = array();
						/* delete some attachments that not send in request */
						if (!empty($old_attachments) && !empty($db_gallery_attachment)) {
							$db_saved_gallery_imgs = !empty($db_gallery_attachment_arr) ? $db_gallery_attachment_arr : array();
							if (!empty($db_saved_gallery_imgs)) {
								foreach ($db_saved_gallery_imgs as $galleryVals) {
									foreach ($old_attachments as $oldVal) {
										if ($galleryVals['attachment_id'] == $oldVal['attachment_id']) {
											$newGalleryArr[] = array(
												'attachment_id' => (int)$galleryVals['attachment_id'],
												'url' 			=> $galleryVals['url'],
												'name'			=> 	get_the_title((int)$galleryVal['attachment_id'])
											);
											$newAttachment_ids[] = (int)$galleryVal['attachment_id'];
										}
									}
								}
							}
						}

						/* set post thumbnail */
						if (is_array($newAttachment_ids) && !empty($newAttachment_ids[0])) {
							set_post_thumbnail($post_id, $newAttachment_ids[0]);
						}

						update_post_meta($post_id, '_product_attachments', $newGalleryArr);
						$attachment_ids_string  = implode(',', $newAttachment_ids);
						update_post_meta($post_id, '_product_image_gallery', $attachment_ids_string);
					}
				}

				/**
				 * video upload/url
				 * */
				$video_attachment_id = 0;
				$video_url              = !empty($data['video_url']) ? sanitize_text_field($data['video_url']) : '';
				//if upload video
				if (!empty($_FILES) && !empty($_FILES['custom_video_upload'])) {

					$video_file 	    = $_FILES['custom_video_upload'];
					$uploaded_image  	= wp_handle_upload($video_file, array('test_form' => false));
					$file_name		 	= basename($video_file['name']);
					$file_type 		 	= wp_check_filetype($uploaded_image['file']);

					// Prepare an array of post data for the attachment.
					$attachment_details = array(
						'guid' 				=> $uploaded_image['url'],
						'post_mime_type' 	=> $file_type['type'],
						'post_title' 		=> preg_replace('/\.[^.]+$/', '', basename($file_name)),
						'post_content' 		=> '',
						'post_status' 		=> 'inherit'
					);

					$video_attachment_id 		= wp_insert_attachment($attachment_details, $uploaded_image['file']);
					$attach_data 	            = wp_generate_attachment_metadata($video_attachment_id, $uploaded_image['file']);

					wp_update_attachment_metadata($video_attachment_id, $attach_data);
					$video_url              = wp_get_attachment_url($video_attachment_id);
				}
				update_post_meta($post_id, '_product_video', $video_url);
				update_post_meta($post_id, '_product_video_attachment_id', $video_attachment_id);

				/**
				 *  Download able files  
				 * */
				$downloadable_option    			= !empty($data['downloadable_option']) ? $data['downloadable_option'] : 'no';

				if (!empty($downloadable_option) && $downloadable_option === 'yes') {
					$downloadable_attachments_size      = !empty($data['downloadable_attachments_size']) ? $data['downloadable_attachments_size'] : 0;
					$old_attachments    				= !empty($data['downloadable_old_attachments']) ? json_decode(stripslashes($data['downloadable_old_attachments']), true) : array();

					/* handle only urls */
					$downloadable_attachments   	= array();
					$downloadable_urls    				= !empty($data['downloadable_urls']) ? json_decode(stripslashes($data['downloadable_urls']), true) : array();

					if (!empty($downloadable_urls)) {
						foreach ($downloadable_urls as $urls_val) {
							if (empty($urls_val['id'])) {
								//handle new data
								$name   		= !empty($urls_val['title']) ? esc_html($urls_val['title']) : '';
								$file_url       = !empty($urls_val['file']) ? esc_url($urls_val['file']) : '';
								$new_attachemt  = taskbot_temp_upload_to_media($file_url, $post_id);
								$attachment_id  = !empty($new_attachemt['attachment_id']) ? $new_attachemt['attachment_id'] : '';
								$file           = !empty($new_attachemt['url']) ? $new_attachemt['url'] : '';
								$downloadable_attachments[]    = array(
									'id'            => $new_attachemt['attachment_id'],
									'name'          => $name,
									'file'          => $file,
									'download_id'   => $attachment_id,
								);
							} else {
								//handle old data
								$uploaded_media = array();
								$uploaded_media['id']           = intval($urls_val['id']);
								$uploaded_media['file']         = esc_url($urls_val['file']);
								$uploaded_media['name']         = esc_html($urls_val['title']);
								$uploaded_media['download_id']  = esc_html($urls_val['id']);
								$downloadable_attachments[]  	= $uploaded_media;
							}
						}
					}

					if (!empty($_FILES) && $downloadable_attachments_size > 0) {

						/* attached doc from DB */
						$db_download_attachment_arr       	= get_post_meta($post_id, '_downloadable_files', true);
						$db_download_attachment_arr			= !empty($db_download_attachment_arr) ? $db_download_attachment_arr : array();

						/* create array of attachment id's that store in DB */
						$db_download_attachment = array();
						if (!empty($db_download_attachment_arr)) {
							$db_download_attachment 	= wp_list_pluck($db_download_attachment_arr, 'id');
						}

						/* delete all download if empty array received from api's */
						if (empty($old_attachments) && !empty($db_download_attachment)) {
							foreach ($db_download_attachment as $delete_media) {
								if (!empty($delete_media)) {
									wp_delete_attachment($post_id, $delete_media, true);
								}
							}
							update_post_meta($post_id, '_downloadable_files', '');
						}

						/* upload new downloads if exist */
						if (!empty($downloadable_attachments_size) && $downloadable_attachments_size > 0) {
							for ($x = 0; $x < $downloadable_attachments_size; $x++) {
								$downloadable_files 	= $_FILES['downloadable_' . $x];
								$uploaded_image  		= wp_handle_upload($downloadable_files, array('test_form' => false));
								$file_name		 		= basename($downloadable_files['name']);
								$file_type 		 		= wp_check_filetype($uploaded_image['file']);

								/* Prepare an array of post data for the attachment. */
								$attachment_details = array(
									'guid' 				=> $uploaded_image['url'],
									'post_mime_type' 	=> $file_type['type'],
									'post_title' 		=> preg_replace('/\.[^.]+$/', '', basename($file_name)),
									'post_content' 		=> '',
									'post_status' 		=> 'inherit'
								);

								$attach_id 		= wp_insert_attachment($attachment_details, $uploaded_image['file']);
								$attach_data 	= wp_generate_attachment_metadata($attach_id, $uploaded_image['file']);

								wp_update_attachment_metadata($attach_id, $attach_data);
								$downloadable_attachments[]    = array(
									'id'            => $attach_id,
									'name'          => !empty($data['downloadable_' . $x]['name']) ? ($data['downloadable_' . $x]['name']) : get_the_title($attach_id),
									'file'          =>  wp_get_attachment_url($attach_id),
									'download_id'   => $attach_id,
								);
							}
						}

						/* delete some downloads that not send in request */
						if (!empty($old_attachments) && !empty($db_download_attachment)) {
							$updateDownloadsArr = $newAttachment_ids = array();
							$db_saved_downloads = !empty($db_download_attachment_arr) ? $db_download_attachment_arr : array();

							if (!empty($db_saved_downloads) && !empty($old_attachments)) {
								foreach ($db_saved_downloads as $galleryVal) {
									foreach ($old_attachments as $oldAttachmentVal) {
										if ($galleryVal['id'] == $oldAttachmentVal['id']) {
											$updateDownloadsArr[] = array(
												'id' 				=> (int)$galleryVal['id'],
												'name' 				=> $galleryVal['name'],
												'file' 				=> $galleryVal['file'],
												'download_id'		=> 	(int)$galleryVal['download_id']
											);
										}
									}
								}
							}
							$galleryNew_arr = array_merge($downloadable_attachments, $updateDownloadsArr);
							update_post_meta($post_id, '_downloadable_files', $galleryNew_arr);
						} else {
							update_post_meta($post_id, '_downloadable_files', $downloadable_attachments);
						}
					} else {
						//here deal with old data

						/* already attached downloads array from api's */
						$old_attachments = !empty($old_attachments) ? $old_attachments : array();

						/* attached doc from DB */
						$db_download_attachment_arr  	= get_post_meta($post_id, '_downloadable_files', true);
						$db_download_attachment_arr		= !empty($db_download_attachment_arr) ? $db_download_attachment_arr : array();

						/* create array of attachment id's that srote in DB */
						$db_download_attachment = array();
						if (!empty($db_download_attachment_arr)) {
							$db_download_attachment 	= wp_list_pluck($db_download_attachment_arr, 'id');
						}

						/* delete all images if empty array received from api's */
						if (empty($old_attachments) && !empty($db_download_attachment)) {
							foreach ($db_download_attachment as $delete_media) {
								if (!empty($delete_media)) {
									wp_delete_attachment($post_id, $delete_media, true);
								}
							}
							delete_post_meta($post_id, '_downloadable_files');
						} else {
							$newDownloadsArr = $merge_urls_and_array = array();
							/* delete some attachments that not send in request */
							if (!empty($old_attachments) && !empty($db_download_attachment)) {
								$db_saved_downloads_ = !empty($db_download_attachment_arr) ? $db_download_attachment_arr : array();
								if (!empty($db_saved_downloads_)) {
									foreach ($db_saved_downloads_ as $downloadVals) {
										foreach ($old_attachments as $oldVal) {
											if ($downloadVals['id'] == $oldVal['id']) {
												$newDownloadsArr[] = array(
													'id' 				=> (int)$downloadVals['id'],
													'name' 				=> $downloadVals['name'],
													'file' 				=> $downloadVals['file'],
													'download_id'		=> 	(int)$downloadVals['download_id']
												);
											}
										}
									}
								}
							}
							/* merge new urls array if not empty */
							if (!empty($downloadable_attachments)) {
								$merge_urls_and_array = array_merge($downloadable_attachments, $newDownloadsArr);
								update_post_meta($post_id, '_downloadable_files', $merge_urls_and_array);
							} else {
								update_post_meta($post_id, '_downloadable_files', $newDownloadsArr);
							}
						}
					}
				} else {
					update_post_meta($post_id, '_downloadable_files', '');
				}
				update_post_meta($post_id, '_downloadable', $downloadable_option);

				taskbotUpdateStatus($post_id);
				do_action('service_media_attachments_update', $post_id);
				$json['type']               = 'success';
				$json['task_id']            = (int)$post_id;
				$json['attachment_ids']     = $attachment_ids;
				$json['step']               = 4;
				$json['message'] 		    = esc_html__('Woohoo!', 'taskbot-api');
				$json['message_desc'] 		= esc_html__('Task has been updated!', 'taskbot-api');
				return new WP_REST_Response($json, 200);
			} else if (!empty($request['action']) && $request['action'] == 4) {
				$faq_arrays 				= array();
				$task_allowed 				= true;
				$service_status   			= !empty($taskbot_settings['service_status']) ? $taskbot_settings['service_status'] : 'publish';
				$resubmit_service_status    = !empty($taskbot_settings['resubmit_service_status']) ? $taskbot_settings['resubmit_service_status'] : 'no';
				$faq_arr        			= !empty($request['faq_arr']) ?  $request['faq_arr'] : array();

				if (!empty($faq_arr)) {
					foreach ($faq_arr as $faq_val) {
						$faq_arrays[] = array(
							'question' 	=> $faq_val['question'],
							'answer' 	=> $faq_val['answer'],
						);
					}
					update_post_meta($post_id, 'taskbot_service_faqs', $faq_arrays);
				}

				$task_allowed     		= taskbot_task_create_allowed($user_id);
				$post_status            = get_post_status($post_id);
				$post_status            = !empty($post_status) ? $post_status : '';
				if (empty($task_allowed) && ($post_status == 'draft' && $service_status !== 'draft')) {
					$service_status = 'draft';
				}

				if (!empty($post_status) && ($post_status == 'draft' || $post_status == 'pending' || $post_status == 'rejected')) {
					$service_post = array(
						'ID'            => $post_id,
						'post_status'   => $service_status,
					);
					wp_update_post($service_post);

					if (!empty($service_status) && $service_status === 'pending' && !empty($resubmit_service_status) && $resubmit_service_status === 'yes') {
						update_post_meta($post_id, '_post_task_status', 'requested');
					}

					wp_set_object_terms($post_id, 'tasks', 'product_type', true);

					/* Send Email to seller and admin */
					if (class_exists('Taskbot_Email_helper') && !empty($post_id)) {
						$emailData	= array();

						if (class_exists('TaskbotTaskStatuses')) {

							$emailData['seller_name']			= taskbot_get_username($profile_id);
							$emailData['seller_email']		  	= get_userdata($current_user->ID)->user_email;
							$emailData['task_name']			  	= get_the_title($post_id);
							$emailData['task_link']			  	= get_permalink($post_id);
							$emailData['notification_type']     = 'noty_admin_approval';
							$emailData['sender_id']             = $user_id; //seller id
							$emailData['receiver_id']           = taskbot_get_admin_user_id(); //admin id
							$email_helper                       = new TaskbotTaskStatuses();

							if ($taskbot_settings['email_post_task'] == true) {
								$email_helper->post_task_seller_email($emailData);
							}

							if ($taskbot_settings['email_admin_task_approval'] == true) {
								$email_helper->post_task_approval_admin_email($emailData);
								$notifyData						= array();
								$notifyDetails					= array();
								$notifyDetails['task_id']       = $post_id;
								$notifyDetails['seller_id']     = $profile_id;
								$notifyData['receiver_id']		= $user_id;
								$notifyData['type']				= 'submint_task';
								$notifyData['linked_profile']	= $profile_id;
								$notifyData['user_type']		= 'sellers';
								$notifyData['post_data']		= $notifyDetails;
								do_action('taskbot_notification_message', $notifyData);
							} else {
								$notifyData						= array();
								$notifyDetails					= array();
								$notifyDetails['task_id']       = $post_id;
								$notifyDetails['seller_id']     = $profile_id;
								$notifyData['receiver_id']		= $user_id;
								$notifyData['type']				= 'task_approved';
								$notifyData['linked_profile']	= $profile_id;
								$notifyData['user_type']		= 'sellers';
								$notifyData['post_data']		= $notifyDetails;
								do_action('taskbot_notification_message', $notifyData);
							}
						}
					}
				}

				$json['type']           = 'success';
				$json['post_id']        = (int)$post_id;
				$json['faq_id']         = (int)$servicefaq_id;
				$json['step']           = 4;
				$json['redirect']       = $service_page_link;
				$json['message']        = esc_html__('Woohoo!', 'taskbot-api');
				$json['message_desc']   = esc_html__('Task has been added successfully!', 'taskbot-api');

				do_action('taskbot_add_service_faqs_save_activity', $post_id);
				return new WP_REST_Response($json, 200);
			}
		}

		/**
		 * Delete Task
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function delete_task($request)
		{
			/* is demo on */
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			/* validate authentication */
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			if (!class_exists('WooCommerce')) {
				$json['type'] = 'error';
				$json['message'] = esc_html__('WooCommerce plugin needs to be installed.', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			$profile_id  = !empty($request['post_id']) ?  intval($request['post_id']) : 0; /* profile id */
			$user_id  = !empty($request['user_id']) ?  intval($request['user_id']) : 0;
			$task_id  = !empty($request['task_id']) ?  intval($request['task_id']) : 0;

			$post_author  = !empty($task_id) ? get_post_field('post_author', $task_id) : 0;
			$post_author  = !empty($post_author) ? $post_author : 0;

			/* post author check */
			if (empty($post_author) || $post_author != $user_id) {
				$json['type']               = 'error';
				$json['message']         = esc_html__('Restricted Access', 'taskbot-api');
				$json['message_desc']     = esc_html__('You are not allowed to perform this action.', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			if ($task_id) {
				$meta_array	= array(
					array(
						'key'		=> 'task_product_id',
						'value'   	=> $task_id,
						'compare' 	=> '=',
						'type' 		=> 'NUMERIC'
					),
					array(
						'key'		=> '_task_status',
						'value'   	=> 'hired',
						'compare' 	=> '=',
					)
				);

				$taskbot_order_queues    = taskbot_get_post_count_by_meta('shop_order', array('wc-pending', 'wc-on-hold', 'wc-processing', 'wc-completed'), $meta_array);

				if (!empty($taskbot_order_queues)) {
					$json['type']               = 'error';
					$json['message'] 		    = esc_html__('Oops!', 'taskbot-api');
					$json['message_desc'] 		= esc_html__('This task has ongoing orders you cannot remove this task', 'taskbot-api');
					wp_send_json($json);
				}

				$taskbot_delete = wp_delete_post($task_id);

				if ($taskbot_delete) {
					$json['type']               = 'success';
					$json['message'] 		    = esc_html__('Woohoo!', 'taskbot-api');
					$json['message_desc'] 		= esc_html__('Task has been deleted!', 'taskbot-api');
					return new WP_REST_Response($json, 200);
				} else {
					$json['type']               = 'error';
					$json['message'] 		    = esc_html__('Oops!', 'taskbot-api');
					$json['message_desc'] 		= esc_html__('There is an error while removing the task.', 'taskbot-api');
					return new WP_REST_Response($json, 203);
				}
			} else {
				$json['type']               = 'error';
				$json['message'] 		    = esc_html__('Oops!', 'taskbot-api');
				$json['message_desc'] 		= esc_html__('There is an error while removing the task.', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}

		/**
		 * Change task status
		 * On/Off
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function task_status_change($request)
		{
			/* is demo on */
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			/* validate user */
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			/* is woocommerce active */
			if (!class_exists('WooCommerce')) {
				$json['type'] = 'error';
				$json['message'] = esc_html__('WooCommerce plugin needs to be installed.', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			$profile_id  		= !empty($request['post_id']) ?  intval($request['post_id']) : 0; /* profile id */
			$user_id  			= !empty($request['user_id']) ?  intval($request['user_id']) : 0;
			$task_id  			= !empty($request['task_id']) ?  intval($request['task_id']) : 0;
			$task_enable_value  = !empty($request['task_enable']) ?  sanitize_text_field($request['task_enable']) : '';
			$task_allowed     	= taskbot_task_create_allowed($user_id);

			$post_author  = !empty($task_id) ? get_post_field('post_author', $task_id) : 0;
			$post_author  = !empty($post_author) ? $post_author : 0;

			if (empty($post_author) || $post_author != $user_id || empty($task_allowed)) {
				$json['type']               = 'error';
				$json['message']         = esc_html__('Restricted Access', 'taskbot-api');
				$json['message_desc']     = esc_html__('You are not allowed to perform this action.', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			$post_status            = get_post_status($task_id);
			if (!empty($post_status) && $post_status === 'pending') {
				$json['type']       = 'error';
				$json['message']    = esc_html__('This task need to admin approval.', 'taskbot-api');
				wp_send_json($json);
			}

			if ($task_id) {

				if ($task_enable_value == 'enable' && empty($task_allowed)) {
					$json['type']               = 'error';
					$json['message'] 		    = esc_html__('Oops!', 'taskbot-api');
					$json['message_desc'] 		= esc_html__('You are not allowed to update status. Please upgrade your package to continue.', 'taskbot-api');
					return new WP_REST_Response($json, 203);
				}

				if ($task_enable_value == 'enable' && $task_allowed == true) {
					$service_status = 'publish';
				} else {
					$service_status = 'private';
				}

				$taskbot_service_data = array(
					'post_status'  => esc_html($service_status),
				);

				$taskbot_service_data['ID'] = $task_id;
				wp_update_post($taskbot_service_data);

				$json['type']               = 'success';
				$json['message'] 		    = esc_html__('Woohoo!', 'taskbot-api');
				$json['message_desc'] 		= esc_html__('Task status has been updated!.', 'taskbot-api');
				return new WP_REST_Response($json, 200);
			} else {
				$json['type']               = 'error';
				$json['message'] 		    = esc_html__('Oops!', 'taskbot-api');
				$json['message_desc'] 		= esc_html__('There is error while updating Task status in database.', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}

		/**
		 * Creat sub task
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function create_sub_task($request)
		{
			$data             = $request;

			$response	= $this->taskbot_is_mobile_demo_site($data);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response	= $this->taskbotAuthentication($data);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$task_id          = (!empty($data['task_id'])) ? intval($data['task_id']) : '';
			$profile_id          = (!empty($data['post_id'])) ? intval($data['post_id']) : ''; /* profile id */
			$subtask_id       = (!empty($data['subtask_id'])) ? intval($data['subtask_id']) : '';
			$user_id          = (!empty($data['user_id'])) ? intval($data['user_id']) : '';
			$subtask_title    = (!empty($data['title'])) ? sanitize_text_field($data['title']) : '';
			$subtask_price    = (!empty($data['price'])) ? floatval($data['price']) : '';
			$subtask_content  = (!empty($data['content'])) ? sanitize_textarea_field($data['content']) : '';
			$validation_fields  = array(
				'service_id'        => esc_html__('There is an error occur, please try again later', 'taskbot-api'),
				'title'             => esc_html__('Add-on title is required', 'taskbot-api'),
				'price'             => esc_html__('Add-on price is required', 'taskbot-api'),
				'user_id'           => esc_html__('There is an error occur, please try again later', 'taskbot-api'),
			);

			foreach ($validation_fields as $key => $validation_field) {
				if (empty($data[$key])) {
					$json['type']           = 'error';
					$json['message']        = esc_html__('Oops!', 'taskbot-api');
					$json['message_desc']   = $validation_field;
					return new WP_REST_Response($json, 203);
				}
			}

			if (empty($task_id)) {
				$json['type']           = 'error';
				$json['message']        = esc_html__('Oops', 'taskbot-api');
				$json['message_desc']   = esc_html__('There is error while saving into database', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			// Update post
			$taskbot_post_data = array(
				'post_title'    => wp_strip_all_tags($subtask_title),
				'post_content'  => $subtask_content,
				'post_status'   => 'publish',
				'post_type'     => 'product',
				'post_author'   => $user_id,
				'meta_input'   => array(
					'_regular_price'    => $subtask_price,
					'_price'            => $subtask_price,
				),
			);

			if (!empty($subtask_id)) {
				// Update the post into the database
				$taskbot_post_data['ID'] = $subtask_id;
				wp_update_post($taskbot_post_data);
			} else {
				// insert the post into the database
				$subtask_id = wp_insert_post($taskbot_post_data);
			}

			if (!empty($subtask_id)) {
				update_post_meta($subtask_id, '_regular_price', $subtask_price);
				update_post_meta($subtask_id, '_price', $subtask_price);
				wp_set_object_terms($subtask_id, 'subtasks', 'product_type', false);
				update_post_meta($subtask_id, '_virtual', 'yes');
				$taskbot_post_data = array(
					'id' => (int)$subtask_id,
					'title' => wp_strip_all_tags($subtask_title),
					'price' => html_entity_decode(get_woocommerce_currency_symbol()) . $subtask_price,
				);

				do_action('taskbot_subtask_update_activity', $task_id, $subtask_id);

				$json['type']               = 'success';
				$json['subtask_id']         = (int)$subtask_id;
				$json['subtask_data']       = $taskbot_post_data;
				$json['message'] 		    = esc_html__('Woohoo!', 'taskbot-api');
				$json['message_desc'] 	    = esc_html__('Add-on added successfully!.', 'taskbot-api');
				return new WP_REST_Response($json, 200);
			} else {
				$json['type']           = 'error';
				$json['message']        = esc_html__('Oops', 'taskbot-api');
				$json['message_desc']   = esc_html__('There is an error occur, please try again later', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}

		/**
		 * Get tasks
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function get_tasks($request)
		{
			global $taskbot_settings;
			$type           = !empty($request['type']) ?  $request['type'] : '';
			$limit			= !empty($request['show_posts']) ? intval($request['show_posts']) : 10;
			$page_number	= !empty($request['page_number']) ? intval($request['page_number']) : 1;

			$task_list = $query_args = $tax_queries = $task_data = array();
			$count_post     = 0;

			$product_type_tax_args[] = array(
				'taxonomy' => 'product_type',
				'field'    => 'slug',
				'terms'    => 'tasks',
			);

			$tax_queries = array_merge($tax_queries, $product_type_tax_args);

			if (!empty($type) && $type === 'manage_tasks') {
				$user_id			= !empty($request['user_id']) ? $request['user_id'] : 0;
				$post_status		= !empty($request['post_status']) ? $request['post_status'] : 'any';

				if (empty($user_id)) {
					$json['type']           = 'error';
					$json['message']        = esc_html__('Oops', 'taskbot-api');
					$json['message_desc']   = esc_html__('Something went wrong', 'taskbot-api');
					return new WP_REST_Response($json, 203);
				}

				$query_args = array(
					'post_type'         => 'product',
					'post_status'       => $post_status,
					'posts_per_page'    => $limit,
					'paged'             => $page_number,
					'author'            => $user_id,
					'orderby'           => 'date',
					'order'             => 'DESC',
					'tax_query'         => array(
						array(
							'taxonomy' => 'product_type',
							'field'    => 'slug',
							'terms'    => 'tasks',
						),
					),
				);

				$task_data = new WP_Query($query_args);
			} elseif (!empty($type) && $type === 'post_ids') {
				$task_id		= !empty($request['post_id']) ? array($request['post_id']) : 0;
				$query_args = array(
					'post__in'              => $task_id,
					'posts_per_page'        => $limit,
					'paged'                 => $page_number,
					'post_type'             => 'product',
					'post_status'           => 'publish',
					'ignore_sticky_posts'   => 1,
					'meta_key'              => '_wc_average_rating',
					'orderby'               => 'meta_value_num',
					'tax_query'             => $tax_queries,

				);
				$task_data = new WP_Query($query_args);
			} elseif (!empty($type) && $type === 'saved') {
				$profile_id		    = !empty($request['profile_id']) ? intval($request['profile_id']) : 0;
				$saved_tasks		= get_post_meta($profile_id, '_saved_tasks', true);
				$saved_items		= !empty($saved_tasks) ? $saved_tasks : array(0);
				$query_args = array(
					'post__in'              => $saved_items,
					'posts_per_page'        => $limit,
					'paged'                 => $page_number,
					'post_type'             => 'product',
					'post_status'           => 'publish',
					'ignore_sticky_posts'   => 1,
					'orderby'           	=> 'date',
					'order'             	=> 'DESC',
				);
				$task_data = new WP_Query($query_args);
			} elseif (!empty($type) && $type === 'top_rated') {
				$query_args = array(
					'posts_per_page'        => $limit,
					'paged'                 => $page_number,
					'post_type'             => 'product',
					'post_status'           => 'publish',
					'ignore_sticky_posts'   => 1,
					'meta_key'              => '_wc_average_rating',
					'orderby'               => 'meta_value_num',
					'tax_query'             => $tax_queries,

				);

				$task_data = new WP_Query($query_args);
			} elseif (!empty($type) && $type === 'search') {
				$meta_queries = $query_args = $user_meta_queries = $user_ids = $product_type_tax_args  = $min_price_meta_args 	= array();

				$sorting                = !empty($request['sort_by']) ? esc_attr($request['sort_by']) : '';
				if (!empty($sorting)) {
					$filtered_args = array();
					// filter latest product
					if ($sorting == 'date_desc') {
						$filtered_args['sort_by'] = array(
							'orderby' 	=> 'date',
							'order' 	=> 'DESC',
						);
					} elseif ($sorting == 'price_desc') {
						$filtered_args['sort_by'] = array(
							'orderby' 	=> 'meta_value_num',
							'meta_key' 	=> '_price',
							'order' 	=> 'desc',
						);
					} elseif ($sorting == 'price_asc') {
						$filtered_args['sort_by'] = array(
							'orderby' 	=> 'meta_value_num',
							'meta_key' 	=> '_price',
							'order' 	=> 'asc',
						);
					} elseif ($sorting == 'views_desc') {
						$filtered_args['sort_by'] = array(
							'orderby' 	=> 'meta_value_num',
							'meta_key' 	=> 'taskbot_service_views',
							'order' 	=> 'desc',
						);
					} elseif ($sorting == 'orders_desc') {
						$filtered_args['sort_by'] = array(
							'orderby' 	=> 'meta_value_num',
							'meta_key' 	=> 'total_sales',
							'order' 	=> 'desc',
						);
					} elseif ($sorting == 'reviews_desc') {
						$filtered_args['sort_by'] = array(
							'orderby' 	=> 'meta_value_num',
							'meta_key' 	=> '_wc_average_rating',
							'order' 	=> 'desc',
						);
					}

					$query_args = array_merge($query_args, $filtered_args['sort_by']);
				}

				// handled category filter in query args
				$category         = $sub_category     = '';
				$category_id      = $sub_category_id  = 0;
				$service_array    = $service_ids      = array();

				if (!empty($request['category']) && $request['category'] != -1) {

					// check and get parent category info
					$category = esc_html($request['category']);
					$category_obj = get_term_by('slug', $category, 'product_cat');
					if (!empty($category_obj)) {
						$category_id = $category_obj->term_id;
						$service_ids = $category_id;
					}

					// check and get sub category info
					if (!empty($request['sub_category'])) {
						$service_ids = array();
						$sub_category = esc_html($request['sub_category']);
						$sub_category_obj = get_term_by('slug', $sub_category, 'product_cat');
						if (!empty($sub_category_obj)) {
							$sub_category_id = $sub_category_obj->term_id;
							$service_ids = $sub_category_id;
						}
					}

					// check and get third level category info, on this level we have service array
					if (!empty($request['service'])) {
						$service_ids = array();
						$service_array = array_map('esc_attr', $request['service']);
						foreach ($service_array as $service) {

							$service_obj = get_term_by('slug', $service, 'product_cat');
							if (!empty($service_obj)) {
								$service_id = $service_obj->term_id;
								array_push($service_ids, $service_id);
							}
						}
					}

					// here we are having another taxonomy so let define the relation
					$query_relation = array('relation' => 'AND',);
					$tax_queries = array_merge($query_relation, $tax_queries);

					// handled searched by product cat taxonomy
					$product_cat_tax_args[] = array(
						'taxonomy'  => 'product_cat',
						'terms'     => $service_ids,
						'field'     => 'term_id',
						'operator'  => 'IN',
					);

					// append product_cat taxonomy args in $tax_queries array
					$tax_queries = array_merge($tax_queries, $product_cat_tax_args);
				}

				// check and store filter variable data
				$keyword            = !empty($request['keyword']) ? sanitize_text_field($request['keyword']) : "";
				$location           = !empty($request['location']) ? sanitize_text_field($request['location']) : "";
				$min_product_price  = !empty($request['min_price']) ? ($request['min_price']) : 0;
				$max_product_price  = !empty($request['max_price']) ? ($request['max_price']) : 0;

				// if keyword field is set in search then append its args in $query_args
				if (!empty($keyword)) {
					$filtered_args['keyword'] = array('s' => $keyword,);
					$query_args = array_merge($query_args, $filtered_args['keyword']);
				}

				// if min price field is set in search then append it in meta query
				if (!empty($min_product_price)) {
					$min_price_meta_args[] = array(
						'key'       => '_regular_price',
						'value'     => $min_product_price,
						'compare'   => '>=',
						'type'      => 'NUMERIC',
					);

					// store basic taxonomy in $tax_queries array
					$meta_queries = array_merge($meta_queries, $min_price_meta_args);
				}

				// if max price field is set in search then append it in meta query
				if (!empty($max_product_price)) {

					if (count($meta_queries) == 1) {
						$query_relation = array('relation' => 'AND',);
						$meta_queries = array_merge($query_relation, $meta_queries);
					}

					$max_price_meta_args[] = array(
						'key'       => '_max_price',
						'value'     => $max_product_price,
						'compare'   => '<=',
						'type'      => 'NUMERIC',
					);
					$meta_queries = array_merge($meta_queries, $max_price_meta_args);
				}

				// if location field is set in search then append it in meta query
				if (!empty($location)) {

					if (count($meta_queries) == 1) {
						$query_relation = array('relation' => 'AND',);
						$meta_queries = array_merge($query_relation, $meta_queries);
					}

					$product_country_meta_args[] = array(
						'key'       => '_country',
						'value'     => $location,
						'compare'   => '=',
						'type'      => 'CHAR',
					);

					$meta_queries = array_merge($meta_queries, $product_country_meta_args);
				}

				if (!empty($request['tags'])) {
					$product_tag_args[] = array(
						'taxonomy' => 'product_tag',
						'field'    => 'slug',
						'terms'    => esc_html($request['tags']),
					);

					$tax_queries = array_merge($tax_queries, $product_tag_args);
				}
				// prepared query args
				$taskbot_args = array(
					'post_type'         => 'product',
					'post_status'       => 'publish',
					'posts_per_page'    => $limit,
					'paged'             => $page_number,
					'tax_query'         => $tax_queries,
					'meta_query'        => $meta_queries,
				);

				$taskbot_args       = array_merge($taskbot_args, $query_args);
				$task_data          = new WP_Query(apply_filters('taskbot_service_listings_args', $taskbot_args));
			}

			if (!empty($type) && !empty($task_data) && $task_data->have_posts()) {
				$count_post = $task_data->found_posts;
				while ($task_data->have_posts()) {
					$task_data->the_post();
					$list                   = array();
					$post_id                = get_the_ID();
					if (function_exists('taskbot_task_details')) {
						$list   = taskbot_task_details($post_id, $request);
					}
					$task_list[]            = $list;
				}
			}

			$json                       = array();
			$json['tasks']              = $task_list;
			$json['count_totals']       = !empty($count_post) ? intval($count_post) : 0;
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Get task data
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function get_task_data($request)
		{
			global $taskbot_settings;
			$post_id                    = !empty($request['post_id']) ?  intval($request['post_id']) : 0; /* profile id */
			$user_id                    = get_post_field('post_author', $post_id);
			$taskbot_service_plans      = Taskbot_Service_Plans::service_plans();
			$taskbot_subtasks_selected  = get_post_meta($post_id, 'taskbot_product_subtasks', TRUE);
			$taskbot_service_plans      = !empty($taskbot_service_plans) ? $taskbot_service_plans : array();
			$service_categories         = wp_get_post_terms($post_id, 'product_cat', array('fields' => 'ids'));
			$json = $field_array = $sub_tasks = array();
			$args = array(
				'limit'     => -1, // All products
				'status'    => 'publish',
				'type'      => 'subtasks',
				'orderby'   => 'date',
				'order'     => 'DESC',
				'author'    => $user_id
			);

			$taskbot_subtasks = wc_get_products($args);
			if (!empty($taskbot_subtasks) && is_array($taskbot_subtasks) && count($taskbot_subtasks) > 0) {
				foreach ($taskbot_subtasks as $subtask) {
					$sub_tasks_data['name']         = $subtask->get_name();
					$sub_tasks_data['id']           = $subtask->get_id();
					$sub_tasks_data['price']                = $subtask->get_price();
					$sub_tasks_data['price_formate']        = taskbot_price_format($subtask->get_price(), 'return', true);
					$sub_tasks_data['selected']             = 'no';
					if (!empty($taskbot_subtasks_selected) && is_array($taskbot_subtasks_selected) && in_array($subtask->get_id(), $taskbot_subtasks_selected)) {
						$sub_tasks_data['selected']   = 'yes';
					}
					$sub_tasks[]    = $sub_tasks_data;
				}
			}

			if (class_exists('ACF')) {
				$groups = acf_get_field_groups();
				foreach ($groups as $group) {
					foreach ($group['location'] as $group_locations) {
						$taskbot_plan_category = '';
						$product_plans_category = 'am-plans-category';
						$found_key = array_search('product_plans_category', array_column($group_locations, 'param'));

						if ($found_key) {
							$group_location_category = $group_locations[$found_key];

							if (isset($group_location_category['param']) && $group_location_category['param'] == 'product_plans_category' && !empty($group_location_category['value'])) {
								$product_plans_category .= ' am-category-' . $group_location_category['value'];
								$taskbot_plan_category = $group_location_category['value'];
							}
						}

						$product_plans_category = apply_filters('taskbot_product_plans_category', $product_plans_category);
						$found_key = '';

						if (!empty($service_categories) && is_array($service_categories) && !in_array($taskbot_plan_category, $service_categories)) {
							continue;
						}

						foreach ($group_locations as $rule) {
							if ($rule['param'] == 'product_tabs' && $rule['operator'] == '==' && $rule['value'] == 'plan') {
								$field_array[]  = acf_get_fields($group['key']);
								break 2;
							}
						}
					}
				}
			}

			$json['field_array']            = $field_array;
			$json['sub_tasks']              = $sub_tasks;
			$json['service_plans']          = $taskbot_service_plans;
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Task complete
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function taskComplete($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$task_id        = !empty($request['task_id']) ? intval($request['task_id']) : 0;
			$user_id        = !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$order_id       = !empty($request['order_id']) ? intval($request['order_id']) : 0;
			$type           = !empty($request['type']) ? sanitize_text_field($request['type']) : '';
			$post_author    = get_post_meta($order_id, 'buyer_id', true);
			$gmt_time		= current_time('mysql', 1);

			$validation_fields  = array(
				'task_id'   => esc_html__('You are not allowed to perform this action', 'taskbot-api'),
				'order_id'  => esc_html__('You are not allowed to perform this action', 'taskbot-api')
			);

			if (!empty($type) && $type == 'rating') {
				$validation_fields['rating']          = esc_html__('You need to add rating', 'taskbot-api');
				$validation_fields['rating_title']    = esc_html__('You need to add rating title', 'taskbot-api');
				$validation_fields['rating_details']  = esc_html__('You need to add rating details', 'taskbot-api');
			}

			foreach ($validation_fields as $key => $validation_field) {

				if (empty($request[$key])) {
					$json['type']               = 'error';
					$json['message_desc'] 		= $validation_field;
					return new WP_REST_Response($json, 203);
				}
			}

			if (empty($post_author) || $post_author != $user_id) {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('You are not allowed to perform this action', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			$post_id		= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id		= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$user_type		= get_post_type($post_id);

			if (!empty($user_type) && $user_type === 'buyers') {
				$response		= taskbotTaskComplete($user_id, $request, 'mobile');
				$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
				return new WP_REST_Response($response, $response_status);
			}
		}

		/**
		 * update dispute status
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function updateDisputeStatus($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$fields	= array(
				'dispute_id'	=> esc_html__('You are not allowed to perform this action', 'taskbot-api')
			);
			foreach ($fields as $key => $item) {
				if (empty($request[$key])) {
					$json['type'] 	 		= "error";
					$json['message_desc'] 	= $item;
					return new WP_REST_Response($json, 200);
				}
			}

			$post_id		= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$dispute_id  	= !empty($request['dispute_id']) ?  $request['dispute_id'] : 0;
			$response		= taskbotUpdateDisputeStatus($dispute_id, 'disputed', 'mobile');
			return new WP_REST_Response($response, 200);
		}

		/**
		 * Create dispute
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function createDispute($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$fields	= array(
				'task_id'     		=> esc_html__('You are not allowed to perform this action', 'taskbot-api'),
				'order_id'     		=> esc_html__('You are not allowed to perform this action', 'taskbot-api'),
				'dispute_issue'     => esc_html__('Please select the dispute reason', 'taskbot-api'),
				'dispute_details' 	=> esc_html__('Please add dispute details', 'taskbot-api'),
				'dispute_terms' 	  => esc_html__('You must select terms and conditions', 'taskbot-api'),
			);
			foreach ($fields as $key => $item) {
				if (empty($request[$key])) {
					$json['type'] 	 = "error";
					$json['message_desc'] = $item;
					return new WP_REST_Response($json, 200);
				}
			}

			$post_id		= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id		= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$user_type		= get_post_type($post_id);

			$request['dispute-details']	= !empty($request['dispute_details']) ? $request['dispute_details'] : '';
			if (!empty($user_type) && $user_type === 'sellers') {

				$response			= taskbotSellerCreateDispute($user_id, $request, 'mobile');
				$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
				return new WP_REST_Response($response, $response_status);
			} else if (!empty($user_type) && $user_type === 'buyers') {
				$response			= taskbotBuyerCreateDispute($user_id, $request, 'mobile');
				$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
				return new WP_REST_Response($response, $response_status);
			}
		}

		/**
		 * Update dispute comment
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function UpdateDisputeComment($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id			= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$response			= taskbot_update_dispute_comments($user_id, $request, 'mobile');
			$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
			return new WP_REST_Response($response, $response_status);
		}

		/**
		 * get disputes
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getDisputes($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			global $taskbot_settings;
			$json 	 		= array();
			$post_id		= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id		= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$type			= !empty($request['type']) ? esc_attr($request['type']) : '';
			$page_number	= !empty($request['page_number']) ? intval($request['page_number']) : 1;
			$per_page_itme	= !empty($request['show_posts']) ? intval($request['show_posts']) : 10;
			$sortby			= !empty($request['sortby']) ? esc_html($request['sortby']) : '';
			//$dispute_id		= !empty($request['dispute_id']) ? intval($request['dispute_id']) : 0;
			$proposal_id	= !empty($request['proposal_id']) ? intval($request['proposal_id']) : 0;

			$buyer_dispute_days	= !empty($taskbot_settings['buyer_dispute_option'])	? intval($taskbot_settings['buyer_dispute_option']) : 5;

			$order          = 'DESC';
			$sorting        = 'ID';
			$user_type		= get_post_type($post_id);
			$order_list		= array();

			if (class_exists('WooCommerce')) {

				$label		= esc_html__('Buyer name', 'taskbot-api');
				$meta_key	= '_seller_id';

				if ($user_type == 'buyers') {
					$meta_key	= '_buyer_id';
					$label		= esc_html__('Seller name', 'taskbot-api');
				}

				$dispute_status	= 'any';
				if (!empty($sortby)) {
					if ($sortby === 'disputed') {
						$dispute_status	= array('disputed');
					} elseif ($sortby === 'resolve') {
						$dispute_status	= array('resolved', 'refunded');
					}
				}
				$taskbot_args = array(
					'post_type'         => 'disputes',
					'post_status'       => $dispute_status,
					'posts_per_page'    => $per_page_itme,
					'paged'             => $page_number,
					'orderby'           => 'date',
					'order'             => 'DESC',
					'meta_query' => array(
						array(
							'key'     => $meta_key,
							'value'   => $user_id,
							'compare' => '=',
						),
					),
				);

				if (!empty($type) && $type === 'single') {
					$dispute_id  				= get_post_meta($proposal_id, 'dispute_id', true);
					$dispute_id     			= !empty($dispute_id) ? $dispute_id : 0;
					$taskbot_args['post__in'] 	= array($dispute_id);
				}

				$taskbot_query = new WP_Query(apply_filters('taskbot_dispute_listings_args', $taskbot_args));

				$count_post 		= $taskbot_query->found_posts;

				if ($taskbot_query->have_posts()) {
					while ($taskbot_query->have_posts()) : $taskbot_query->the_post();
						global $post;
						$order_item		= array();
						$dispute_id   	= $post->ID;
						$task_id    	= get_post_meta($dispute_id, '_task_id', true);
						$seller_id    	= get_post_meta($dispute_id, '_seller_id', true);
						$buyer_id    	= get_post_meta($dispute_id, '_buyer_id', true);
						$order_id		= get_post_meta($dispute_id, '_dispute_order', true);
						$dispute_key	= get_post_meta($dispute_id, '_dispute_key', true);
						$seller_id      = !empty($seller_id) ? intval($seller_id) : 0;
						$buyer_id       = !empty($buyer_id) ? intval($buyer_id) : 0;
						$final_date		= esc_html(date_i18n(get_option('date_format'),  strtotime($post->post_date . ' + ' . intval($buyer_dispute_days) . ' days')));

						$seller_prof_id					= taskbot_get_linked_profile_id($seller_id, '', 'sellers');
						$buyer_prof_id					= taskbot_get_linked_profile_id($buyer_id, '', 'buyers');

						$order_item['date']				= date_i18n(get_option('date_format'),  strtotime(get_the_date()));
						$order_item['buyer_image']    	= apply_filters('taskbot_avatar_fallback', taskbot_get_user_avatar(array('width' => 315, 'height' => 300), $buyer_prof_id), array('width' => 315, 'height' => 300));
						$order_item['seller_image']    	= apply_filters('taskbot_avatar_fallback', taskbot_get_user_avatar(array('width' => 315, 'height' => 300), $seller_prof_id), array('width' => 315, 'height' => 300));
						$order_item['price']    		= taskbot_price_format(taskbot_order_price($order_id), 'return');
						$order_item['seller_name']    	= taskbot_get_username($seller_prof_id);
						$order_item['buyer_name']    	= taskbot_get_username($buyer_prof_id);
						$order_item['status']    		= get_post_status($dispute_id);
						$order_item['seller_id']    	= intval($seller_id);
						$order_item['order_id']    		= intval($order_id);
						$order_item['dispute_id']    	= intval($dispute_id);
						$order_item['buyer_id']    		= intval($buyer_id);
						$order_item['final_date']    	= esc_html($final_date);
						$order_item['post_author']    	= !empty($dispute_id) ? intval(get_post_field('post_author', $dispute_id)) : 0;
						$order_item['task_title'] 		= !empty($task_id) ? get_the_title($task_id) : '';
						$order_item['dispute_title'] 	= !empty($dispute_key) ? esc_html($dispute_key) : '';
						$order_item['dispute_content'] 	= get_the_content($dispute_id);
						//$order_item['dispute_for'] 		= get_the_content($dispute_id);

						/* check disputed from project/task */
						$order_item['dispute_type']  = '';
						$project_id         = get_post_meta($dispute_id, '_project_id', true);
						if (!empty($project_id)) {
							$order_item['dispute_type']  = 'project';
						} else {
							$task_id         = get_post_meta($dispute_id, '_task_id', true);
							if (!empty($task_id)) {
								$order_item['dispute_type']  = 'task';
							}
						}

						/* getting comments */
						$args   = array(
							'post_id'       	=> $dispute_id,
							'hierarchical' 		=> true,
							'order'     		=> 'ASC',
						);

						$comments = get_comments($args);
						$dispute_comments	= array();
						if (isset($comments) && !empty($comments)) {
							foreach ($comments as $key => $value) {
								$comment_children 	= array();
								$comment_children 	= $value->get_children();
								$commentsData		= taskbot_get_chat_history($value, $user_id);

								if (!empty($comment_children)) {
									foreach ($comment_children as $comment_child) {
										$commentsChildData		= taskbot_get_chat_history($comment_child, $user_id);
										$commentsData['child']	= $commentsChildData;
									}
								}
								$dispute_comments[]	= $commentsData;
							}
						}
						$order_item['dispute_comments']    	= $dispute_comments;
						$order_list[]					= $order_item;

					endwhile;
				}
			}

			return new WP_REST_Response($order_list, 200);
		}

		/**
		 * Downalod attachments
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */

		public function downloadAttachments($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$json 	 		= array();
			$post_id		= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id		= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$type			= !empty($request['type']) ? esc_attr($request['type']) : '';

			$attachment_id	=  !empty($request['comments_id']) ? intval($request['comments_id']) : '';

			if (empty($attachment_id)) {
				$json['type']		= 'error';
				$json['message_desc']	= esc_html__('Attachment is missing', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			} else {

				if (!empty($type) && $type === 'projects') {
					$project_files = get_post_meta($attachment_id, '_downloadable_files', true);
				} else {
					$project_files = get_comment_meta($attachment_id, 'message_files', true);
				}
				$download_url	= '';
				if (!empty($project_files)) {

					if (class_exists('ZipArchive')) {
						$zip                  = new ZipArchive();
						$uploadspath	      = wp_upload_dir();
						$folderRalativePath   = $uploadspath['baseurl'] . "/downloads";
						$folderAbsolutePath   = $uploadspath['basedir'] . "/downloads";

						wp_mkdir_p($folderAbsolutePath);

						$rand	        = taskbot_unique_increment(5);
						$filename	    = $rand . round(microtime(true)) . '.zip';
						$zip_name     	= $folderAbsolutePath . '/' . $filename;
						$download_url	= $folderRalativePath . '/' . $filename;
						$zip->open($zip_name,  ZipArchive::CREATE);

						foreach ($project_files as $key => $value) {
							if ($type === 'projects') {
								$file_url	= taskbot_add_http_protcol($value['file']);
							} else {
								$file_url	= taskbot_add_http_protcol($value['url']);
							}
							$response	= wp_remote_get($file_url);
							$filedata 	= wp_remote_retrieve_body($response);
							$zip->addFromString(basename($file_url), $filedata);
						}

						$zip->close();
					} else {
						$json['type'] 		= 'error';
						$json['message_desc'] 	= esc_html__('Zip library is not installed on the server, please contact to hosting provider', 'taskbot-api');
						return new WP_REST_Response($json, 203);
					}
				}

				$json['type'] 			= 'success';
				$json['attachment'] 	= taskbot_add_http_protcol($download_url);
				$json['message_desc'] 	= esc_html__('File has been downloaded', 'taskbot-api');
				return new WP_REST_Response($json, 200);
			}
		}

		/**
		 * get order comments
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getOrderComments($request)
		{
			$$json		= array();
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id		= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id		= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$order_id		= !empty($request['order_id']) ? intval($request['order_id']) : 0;
			$args   = array(
				'post_id'       => $order_id,
				'orderby'       => 'date',
				'order'         => 'ASC',
				'hierarchical' => 'threaded',
			);
			$comments 		= get_comments($args);
			$task_comments	= array();
			if (isset($comments) && !empty($comments)) {
				foreach ($comments as $key => $value) {
					$comment_children 	= array();
					$comment_children 	= $value->get_children();
					$commentsData		= taskbot_get_chat_history($value, $user_id);

					if (!empty($comment_children)) {
						foreach ($comment_children as $comment_child) {
							$commentsChildData		= taskbot_get_chat_history($comment_child, $user_id);
							$commentsData['child']	= $commentsChildData;
						}
					}
					$task_comments[]	= $commentsData;
				}
			}
			$json['task_comments']	= $task_comments;
			return new WP_REST_Response($json, 200);
		}
		/**
		 * get invoices
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getOrders($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$json 	 		= array();
			$post_id		= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id		= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$type			= !empty($request['type']) ? esc_attr($request['type']) : '';
			$page_number	= !empty($request['page_number']) ? intval($request['page_number']) : 1;
			$per_page_itme	= !empty($request['per_page_itme']) ? intval($request['per_page_itme']) : 10;
			$order_type     = !empty($request['order_type']) ? esc_attr($request['order_type']) : 'any';
			$order_status   = array('wc-completed', 'wc-pending', 'wc-on-hold', 'wc-cancelled', 'wc-refunded', 'wc-processing');
			$order          = 'DESC';
			$sorting        = 'ID';
			$user_type		= get_post_type($post_id);
			$order_list		= array();

			$args 			= array(
				'posts_per_page' 	  => $per_page_itme,
				'post_type' 		  => 'shop_order',
				'orderby' 			  => $sorting,
				'order' 			  => $order,
				'post_status' 		  => $order_status,
				'paged' 			  => $page_number,
				'suppress_filters' 	  => false
			);
			if (!empty($type) && $type === 'single') {
				$order_post_id		= !empty($request['order_post_id']) ? intval($request['order_post_id']) : 0;
				$args['post__in']	= array($order_post_id);
			}
			$meta_query_args[] = array(
				'key' 		=> 'payment_type',
				'value' 	=> 'tasks',
				'compare' 	=> '='
			);
			if (class_exists('WooCommerce')) {
				if (!empty($user_type) && $user_type === 'sellers') {
					$meta_query_args[] = array(
						'key' 		=> 'seller_id',
						'value' 	=> $user_id,
						'compare' 	=> '='
					);
				} else if (!empty($user_type) && $user_type === 'buyers') {
					$meta_query_args[] = array(
						'key' 		=> 'buyer_id',
						'value' 	=> $user_id,
						'compare' 	=> '='
					);
				}
				if (!empty($order_type) && $order_type != 'any') {

					$meta_query_args[] = array(
						'key' 		=> '_task_status',
						'value' 	=> $order_type,
						'compare' 	=> '='
					);
				}
				$query_relation 	= array('relation' => 'AND',);
				$args['meta_query'] = array_merge($query_relation, $meta_query_args);
				$query 				= new WP_Query($args);
				$count_post 		= $query->found_posts;

				if ($query->have_posts()) {
					while ($query->have_posts()) : $query->the_post();
						global $post;
						$order_item		= array();
						$order_id   	= $post->ID;
						$task_id    	= get_post_meta($order_id, 'task_product_id', true);
						$product_data   = get_post_meta($order_id, 'cus_woo_product_data', true);
						$downloadable   = get_post_meta($task_id, '_downloadable', true);
						$order_details  = get_post_meta($order_id, 'order_details', true);
						$task_status    = get_post_meta($order_id, '_task_status', true);
						$delivery_date  = get_post_meta($order_id, 'delivery_date', true);
						$tb_order_gmt   = get_post_meta($order_id, 'delivery_date', true);
						$dispute   		= get_post_meta($order_id, 'dispute', true);

						$order_details	= !empty($order_details) ? $order_details : array();
						$product_data   = !empty($product_data) ? $product_data : array();
						$task_id    	= !empty($task_id) ? $task_id : 0;
						$task_status    = !empty($task_status) ? $task_status : '';
						$dispute		= !empty($dispute) ? $dispute : '';
						$plan_price		= isset($order_details['price']) ? $order_details['price'] : 0;
						$dispute_id		= !empty($dispute) && $dispute === 'yes' ? get_post_meta($order_id, 'dispute_id', true) : 0;
						$dispute_status	= !empty($dispute_id) ? get_post_status($dispute_id) : '';
						$label			= '';
						switch ($task_status) {
							case 'hired':
								$label      = esc_html__('Ongoing', 'taskbot-api');
								break;
							case 'completed':
								$label      = esc_html__('Completed', 'taskbot-api');
								break;
							case 'cancelled':
								$label      = esc_html__('Cancelled', 'taskbot-api');
								break;
							default:
								$label      = esc_html__('New', 'taskbot-api');
						}

						$tb_order_gmt   = !empty($tb_order_gmt) ? intval($tb_order_gmt) : 0;
						$order 		    = wc_get_order($order_id);
						$order_price    = $order->get_total();
						$get_taxes      = $order->get_total_tax();
						$order_status	= $order->get_status();
						$seller_id      = isset($product_data['seller_id']) ? intval($product_data['seller_id']) : 0;
						$buyer_id       = isset($product_data['buyer_id']) ? intval($product_data['buyer_id']) : 0;
						$downloadable   = !empty($downloadable) ? $downloadable : 0;
						$admin_shares	= isset($product_data['admin_shares']) ? $product_data['admin_shares'] : 0;
						$seller_shares	= isset($product_data['seller_shares']) ? $product_data['seller_shares'] : 0;
						$subtasks		= !empty($order_details['subtasks']) ? $order_details['subtasks'] : array();

						$categories 			= !empty($task_id) ? wp_get_post_terms($task_id, 'product_cat') : 0;
						$categories_array       = array();
						$product_cat            = array();
						if (!empty($categories)) {
							foreach ($categories as $term) {
								$categories_array[$term->slug]   = $term->name;
								$product_cat[]                   = $term->term_id;
							}
						}

						$tasks_array	= array();
						if (!empty($subtasks)) {
							foreach ($subtasks as $subtask) {
								$subtask['price_format']	= isset($subtask['price']) ? taskbot_price_format($subtask['price'], 'return') : 0;
								$tasks_array[]	= $subtask;
							}
						}
						if (!empty($task_status) && $task_status === 'completed') {
							$rating_id  					= get_post_meta($order_id, '_rating_id', true);
							$comment_detail 				= !empty($rating_id) ? get_comment($rating_id) : array();
							$order_item['content']			= !empty($comment_detail->comment_content) ? $comment_detail->comment_content : '';
							$order_item['title']			= !empty($rating_id) ? get_comment_meta($rating_id, '_rating_title', true) : '';
							$order_item['rating_id']		=  !empty($rating_id) ? intval($rating_id) : 0;
							$rating        					= !empty($rating_id) ? get_comment_meta($rating_id, 'rating', true) : 0;
							$rating_avg     				= !empty($rating) ? ($rating / 5) * 100 : 0;
							$order_item['rating']			= $rating;
							$order_item['rating_avg']		= $rating_avg;
						}

						$order_details['subtasks']		= $tasks_array;
						$seller_prof_id					= taskbot_get_linked_profile_id($seller_id, '', 'sellers');
						$buyer_prof_id					= taskbot_get_linked_profile_id($buyer_id, '', 'buyers');
						$order_item['buyer_image']    	= apply_filters('taskbot_avatar_fallback', taskbot_get_user_avatar(array('width' => 315, 'height' => 300), $buyer_prof_id), array('width' => 315, 'height' => 300));
						$order_item['seller_image']    	= apply_filters('taskbot_avatar_fallback', taskbot_get_user_avatar(array('width' => 315, 'height' => 300), $seller_prof_id), array('width' => 315, 'height' => 300));
						$order_item['dispute']    		= $dispute;
						$order_item['dispute_id']   	= $dispute_id;
						$order_item['dispute_details']  = taskbotDisputeDetails($dispute_id);
						$order_item['dispute_status']   = $dispute_status;
						$order_item['order_details']    = $order_details;
						$order_item['delivery_time']	= !empty($delivery_date) ? date_i18n(get_option('date_format'), $delivery_date) : '';
						$order_item['seller_id']    	= $seller_id;
						$order_item['order_id']    		= $order_id;
						$order_item['categories']    	= $categories_array;
						$order_item['buyer_id']    		= $buyer_id;
						$order_item['admin_shares']    	= $admin_shares;
						$order_item['seller_shares']    = $seller_shares;
						$order_item['plan_price']    	= taskbot_price_format($plan_price, 'return');
						$order_item['get_taxes']    	= taskbot_price_format($get_taxes, 'return');
						$order_item['buyer_prof_id']   	= $buyer_prof_id;
						$order_item['seller_prof_id']   = $seller_prof_id;

						$order_item['buyer_name']   	= taskbot_get_username($buyer_prof_id);
						$order_item['seller_name']   	= taskbot_get_username($seller_prof_id);

						$order_item['tb_order_gmt']    	= $tb_order_gmt;
						$order_item['task_status']    	= $task_status;
						$order_item['order_status']    	= $order_status;
						$order_item['task_id']    		= $task_id;
						$order_item['order_label']    	= $label;

						$order_item['order_price']    			= !empty($order_price) ? $order_price : 0;
						$order_item['task_title'] 				= !empty($task_id) ? get_the_title($task_id) : '';
						$order_item['order_price_format']		= !empty($order_price) ? taskbot_price_format($order_price, 'return') : 0;
						$order_item['admin_shares_fromat']    	= taskbot_price_format($admin_shares, 'return');
						$order_item['seller_shares_fromat']    	= taskbot_price_format($seller_shares, 'return');

						$args   = array(
							'post_id'       => $order_id,
							'orderby'       => 'date',
							'order'         => 'ASC',
							'hierarchical' => 'threaded',
						);
						$comments 		= get_comments($args);
						$task_comments	= array();
						if (isset($comments) && !empty($comments)) {
							foreach ($comments as $key => $value) {
								$comment_children 	= array();
								$comment_children 	= $value->get_children();
								$commentsData		= taskbot_get_chat_history($value, $user_id);

								if (!empty($comment_children)) {
									foreach ($comment_children as $comment_child) {
										$commentsChildData		= taskbot_get_chat_history($comment_child, $user_id);
										$commentsData['child']	= $commentsChildData;
									}
								}
								$task_comments[]	= $commentsData;
							}
						}
						$order_item['task_comments']    	= $task_comments;
						$order_list[]						= $order_item;

					endwhile;
				}
			}

			return new WP_REST_Response($order_list, 200);
		}

		/**
		 * Add activity comments
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function UpdateActivities($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$validation_fields  = array(
				'id'				=> esc_html__('Something went wrong please try again.', 'taskbot-api'),
				'activity_detail' 	=> esc_html__('Please add message to send.', 'taskbot-api')
			);
			$json               = array();
			$json['type']       = 'error';

			foreach ($validation_fields as $key => $validation_field) {
				if (empty($request[$key])) {
					$json['message_desc'] 		= $validation_field;
					return new WP_REST_Response($json, 203);
				}
			}

			$user_id			= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$commentdata		= taskbot_update_comments($user_id, $request, 'mobile');
			$response_status	= !empty($commentdata['type']) && $commentdata['type'] === 'error' ? 203 : 200;
			return new WP_REST_Response($commentdata, $response_status);
		}
		/**
		 * get Billing address
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function getBilling($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$json 	 			= array();
			$post_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id			= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;

			$user_data			= array();
			$user_type			= get_post_type($post_id);
			$billing_first_name	= get_user_meta($user_id, 'billing_first_name', true);
			$billing_last_name	= get_user_meta($user_id, 'billing_last_name', true);

			$billing_company	= get_user_meta($user_id, 'billing_company', true);
			$billing_address_1	= get_user_meta($user_id, 'billing_address_1', true);
			$billing_country	= get_user_meta($user_id, 'billing_country', true);
			$billing_city		= get_user_meta($user_id, 'billing_city', true);

			$billing_state		= get_user_meta($user_id, 'billing_state', true);
			$billing_phone		= get_user_meta($user_id, 'billing_phone', true);
			$billing_postcode	= get_user_meta($user_id, 'billing_postcode', true);
			$billing_email		= get_user_meta($user_id, 'billing_email', true);
			$phone_country		= get_user_meta($user_id, 'billing_telephone_country', true);

			$user_data['billing_first_name']	= !empty($billing_first_name) ? $billing_first_name : '';
			$user_data['billing_last_name']		= !empty($billing_last_name) ? $billing_last_name : '';

			$user_data['billing_company']		= !empty($billing_company) ? $billing_company : '';
			$user_data['billing_address_1']		= !empty($billing_address_1) ? $billing_address_1 : '';
			$user_data['billing_country']		= !empty($billing_country) ? $billing_country : '';
			$user_data['billing_city']			= !empty($billing_city) ? $billing_city : '';

			$user_data['billing_state']			= !empty($billing_state) ? $billing_state : '';
			$user_data['billing_phone']			= !empty($billing_phone) ? $billing_phone : '';
			$user_data['billing_postcode']		= !empty($billing_postcode) ? $billing_postcode : '';
			$user_data['phone_country']			= !empty($phone_country) ? $phone_country : 'us';
			$user_data['billing_email']			= !empty($billing_email) ? $billing_email : '';
			return new WP_REST_Response($user_data, 200);
		}

		/**
		 * get invoices
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function listInvoices($request)
		{
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$json 	 		= array();
			$post_id		= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id		= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
			$page_number	= !empty($request['page_number']) ? intval($request['page_number']) : 1;
			$per_page_itme	= !empty($request['show_posts']) ? intval($request['show_posts']) : 10;
			$user_type		= get_post_type($post_id);
			$order_arg  	= array(
				'page'          => $page_number,
				'paginate'      => true,
				'limit'         => $per_page_itme
			);
			if (!empty($user_type) && $user_type === 'sellers') {
				$order_arg['seller_id']  = $user_id;
			} else if (!empty($user_type) && $user_type === 'buyers') {
				$order_arg['buyer_id']  = $user_id;
			}
			$order_list	= array();
			if (class_exists('WooCommerce')) {
				$customer_orders = wc_get_orders($order_arg);
				if (!empty($customer_orders->orders)) {
					$count_post = count($customer_orders->orders);
					foreach ($customer_orders->orders as $order) {
						$order_item		= array();
						$data_created 	= $order->get_date_created();
						$order_total		= 0;
						$payemnt_type_text	= '';
						$payment_type 		= get_post_meta($order->get_id(), 'payment_type', true);
						if (!empty($payment_type)) {
							if ($payment_type === 'package') {
								$payemnt_type_text  = esc_html__('Package subscription', 'taskbot-api');
							} else if ($payment_type === 'wallet') {
								$payemnt_type_text  = esc_html__('Wallet amount', 'taskbot-api');
							} else if ($payment_type === 'tasks') {
								$payemnt_type_text  = esc_html__('Task hiring', 'taskbot-api');
							}
						}

						if (!empty($user_type) && $user_type === 'sellers') {
							$order_total   = get_post_meta($order->get_id(), 'seller_shares', true);
						} else if (!empty($user_type) && $user_type === 'buyers') {
							$order_total       = $order->get_total();
						}
						$order_item['order_id']		= $order->get_id();
						$order_item['payemnt_type']	= $payemnt_type_text;
						$order_item['amount']		= taskbot_price_format($order_total, 'return');
						$order_item['data_created']	= date_i18n(get_option('date_format'), strtotime(apply_filters('taskbot_date_format_fix', $data_created)));
						$order_list[]				= $order_item;
					}
				}
			}
			return new WP_REST_Response($order_list, 200);
		}

		/**
		 * update user settings
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function updateUserSettings($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$post_id	= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$type		= !empty($request['type']) ? esc_attr($request['type']) : '';

			if (!empty($type) && $type === 'deactive_account') {
				$reason		= !empty($request['reason']) ? esc_html($request['reason']) : '';
				$details	= !empty($request['details']) ? esc_html($request['details']) : '';
				$validation_fields  = array(
					'reason'  => esc_html__('Please select deactive account reason.', 'taskbot-api'),
					'details' => esc_html__('Please add deactive account setails.', 'taskbot-api')
				);
				$json               = array();
				$json['type']       = 'error';
				foreach ($validation_fields as $key => $validation_field) {
					if (empty($request[$key])) {
						$json['message_desc'] 		= $validation_field;
						return new WP_REST_Response($json, 203);
					}
				}
				$user_id	= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;
				$user_type	= get_post_type($post_id);
				$userdata	= !empty($user_id) ? get_userdata($user_id) : array();
				$user_name  = taskbot_get_username($post_id);
				update_post_meta($post_id, '_deactive_account', 1);
				if (class_exists('Taskbot_Email_helper')) {
					if (class_exists('DeactiveUserAcoount')) {
						if (!empty($taskbot_settings['email_admin_deactive_account'])) {
							$emailData                 = array();
							$emailData['user_id']      = $user_id;
							$emailData['user_type']    = $user_type;
							$emailData['reason']       = $reason;
							$emailData['details']      = $details;
							$emailData['user_name']    = $user_name;
							$emailData['user_email']   = !empty($userdata) ? $userdata->user_email : '';
							$email_helper              = new DeactiveUserAcoount();
							$email_helper->deactive_account_email_to_admin($emailData);
						}
					}
				}
			} else if (!empty($type) && $type === 'active_account') {
				update_post_meta($post_id, '_deactive_account', 0);
			}
			$json['type'] 		= 'success';
			$json['message_desc'] 	= esc_html__('Settings have been updated successfully', 'taskbot-api');
			return new WP_REST_Response($json, 200);
		}

		/**
		 * update verification document
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function sendVerification($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$json 	 	= array();
			$post_id	= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id	= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;

			$total_documents 		= !empty($request['document_size']) ? $request['document_size'] : 0;
			$required = array(
				'name'   				=> esc_html__('Name is required', 'taskbot-api'),
				'address'   			=> esc_html__('Address is required', 'taskbot-api'),
				'contact_number'  		=> esc_html__('Contact number is required', 'taskbot-api'),
				'verification_number'   => esc_html__('Verification number is required', 'taskbot-api'),

			);

			foreach ($required as $key => $value) {
				if (empty($request[$key])) {
					$json['type'] 		= 'error';
					$json['message_desc'] 	= $value;
					return new WP_REST_Response($json, 203);
				}
			}
			if (empty($total_documents)) {
				$json['type'] = 'error';
				$json['message_desc'] = esc_html__('Please upload a document', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			$verification_files									= array();
			$verification_files['info']['name'] 				= !empty($request['name']) ? esc_html($request['name']) : '';
			$verification_files['info']['contact_number']  		= !empty($request['contact_number']) ? esc_html($request['contact_number']) : '';
			$verification_files['info']['verification_number']  = !empty($request['verification_number']) ? esc_html($request['verification_number']) : '';
			$verification_files['info']['address'] 				= !empty($request['address']) ? esc_html($request['address']) : '';

			if (!empty($_FILES) && $total_documents != 0) {
				require_once(ABSPATH . 'wp-admin/includes/file.php');
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				require_once(ABSPATH . 'wp-includes/pluggable.php');

				$counter	= 0;
				for ($x = 0; $x < $total_documents; $x++) {
					$document_files 	= $_FILES['documents_' . $x];
					$uploaded_image  	= wp_handle_upload($document_files, array('test_form' => false));
					$file_name		 	= basename($document_files['name']);
					$file_type 		 	= wp_check_filetype($uploaded_image['file']);

					// Prepare an array of post data for the attachment.
					$attachment_details = array(
						'guid' 				=> $uploaded_image['url'],
						'post_mime_type' 	=> $file_type['type'],
						'post_title' 		=> preg_replace('/\.[^.]+$/', '', basename($file_name)),
						'post_content' 		=> '',
						'post_status' 		=> 'inherit'
					);

					$attach_id 		= wp_insert_attachment($attachment_details, $uploaded_image['file']);
					$attach_data 	= wp_generate_attachment_metadata($attach_id, $uploaded_image['file']);

					wp_update_attachment_metadata($attach_id, $attach_data);

					$documents['attachment_id']		= $attach_id;
					$documents['name']				= get_the_title($attach_id);
					$documents['url']				= wp_get_attachment_url($attach_id);
					$verification_files[]			= $documents;
				}
			}
			update_user_meta($user_id, 'verification_attachments', $verification_files);
			update_user_meta($user_id, 'identity_verified', 0);
			$current_user 					= get_userdata($user_id);
			$user_type		                = apply_filters('taskbot_get_user_type', $user_id);
			$linked_profile                 = taskbot_get_linked_profile_id($user_id, '', $user_type);
			$notifyData						= array();
			$notifyDetails					= array();
			$notifyData['receiver_id']		= $user_id;
			$notifyData['type']				= 'account_verification_request';
			$notifyData['post_data']		= $notifyDetails;
			$notifyData['user_type']		= $user_type;
			$notifyData['linked_profile']	= $linked_profile;
			do_action('taskbot_notification_message', $notifyData);

			if (class_exists('Taskbot_Email_helper')) {
				if (class_exists('TaskbotIdentityVerification')) {
					$email_helper               = new TaskbotIdentityVerification();
					$username   	            = taskbot_get_username($linked_profile);
					$emailData                  = array();
					$emailData['user_name']  	= $username;
					$emailData['user_link']  	= admin_url('users.php') . '?s=' . $current_user->user_email;
					$emailData['user_email']  	= $current_user->user_email;

					$email_helper->send_verification_to_admin($emailData);
				}
			}

			$json['type'] 		= 'success';
			$json['message_desc'] 	= esc_html__('Successfully! submitted your request for verification', 'taskbot-api');

			return new WP_REST_Response($json, 200);
		}

		/**
		 * update verification document
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Response
		 */
		public function cancelVerification($request)
		{
			$json 	 	= array();
			$post_id	= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id	= !empty($post_id) ? get_post_field('post_author', $post_id) : 0;

			update_user_meta($user_id, 'verification_attachments', '');
			update_user_meta($user_id, 'identity_verified', 0);

			$json['type'] 		= 'success';
			$json['message_desc'] 	= esc_html__('Successfully! deleted your verification request', 'taskbot-api');
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Update billing details
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function updateSettings($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$profile_id		= !empty($request['post_id']) ? $request['post_id'] : 0; /* profile id */
			$option			= !empty($request['option']) ? $request['option'] : 0;
			update_post_meta($profile_id, '_deactive_account', $option);
			$json['type']           = 'success';
			$json['message_desc']   = esc_html__('Your account have been update successfully.', 'taskbot-api');
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Update billing details
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function updatePrivacySettings($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$profile_id		= !empty($request['post_id']) ? $request['post_id'] : 0; /* profile id */
			$user_type		= !empty($profile_id) ? get_post_type($profile_id) : '';
			$settings       = taskbot_get_account_settings($user_type);
			if (!empty($settings)) {
				foreach ($settings as $key => $value) {
					$save_val 	= !empty($request[$key]) ? $request[$key] : '';
					$db_val 	= !empty($save_val) ?  $save_val : 'off';
					update_post_meta($profile_id, $key, $db_val);
				}
				$json['type']           = 'success';
				$json['message_desc']   = esc_html__('Your privacy settings have been updated.', 'taskbot-api');
				return new WP_REST_Response($json, 200);
			}
		}

		/**
		 * Update billing details
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function updateBilingDetails($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$profile_id		= !empty($request['post_id']) ? $request['post_id'] : 0; /* profile id */
			$user_id		= get_post_field('post_author', $profile_id);
			$list = array(
				'billing_first_name'    => esc_html__('First name is required', 'taskbot-api'),
				'billing_last_name'    	=> esc_html__('Last name is required', 'taskbot-api'),
				'billing_company'    	=> esc_html__('Company is required', 'taskbot-api'),
				'billing_address_1'    	=> esc_html__('Address is required', 'taskbot-api'),
				'billing_country'   	=> esc_html__('country is required', 'taskbot-api'),
				'billing_city'    		=> esc_html__('City is required', 'taskbot-api'),
				'billing_postcode'    	=> esc_html__('Postal code is required', 'taskbot-api'),
				'billing_phone'    		=> esc_html__('Phone is required', 'taskbot-api'),
				'billing_email'    		=> esc_html__('email is required', 'taskbot-api'),
			);
			foreach ($list as $meta_key => $meta_value) {
				if (empty($request['billing'][$meta_key])) {
					$json['type'] 		    = 'error';
					$json['message_desc'] 	= esc_html($meta_value);
					return new WP_REST_Response($json, 203);
				}
			}

			foreach ($request['billing'] as $meta_key => $meta_value) {
				update_user_meta($user_id, $meta_key, sanitize_text_field($meta_value));
			}

			$json['type']           = 'success';
			$json['message_desc']   = esc_html__('Your billing settings have been updated.', 'taskbot-api');
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Update profile
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function updateEducation($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$profile_id		= !empty($request['post_id']) ? $request['post_id'] : 0; /* profile id */
			$validation_fields  = array(
				'title'     => esc_html__('Degree title is required', 'taskbot-api'),
				'start_date' => esc_html__('Start date is required', 'taskbot-api')
			);
			foreach ($request['education'] as $key => $value) {
				foreach ($validation_fields as $edu_key => $validation_field) {

					if (empty($value[$edu_key])) {
						$json['message_desc'] 		= $validation_field;
						return new WP_REST_Response($json, 203);
					}
				}
			}

			$tb_post_meta   = get_post_meta($profile_id, 'tb_post_meta', true);
			$tb_post_meta   = !empty($tb_post_meta) ? $tb_post_meta : array();
			$add_education  = !empty($request['education']) ? $request['education'] : array();

			$tb_post_meta['education']  = $add_education;
			update_post_meta($profile_id, 'tb_post_meta', $tb_post_meta);
			$json['type'] 		    = 'success';
			$json['message_desc'] 	= esc_html__('Your education have been updated', 'taskbot-api');
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Update profile
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function updateProfile($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}
			$profile_id		= !empty($request['post_id']) ? $request['post_id'] : 0; /* profile id */
			$user_id		= !empty($profile_id) ? get_post_field('post_author', $profile_id) : 0;
			$user_type      = get_post_type($profile_id);
			global $taskbot_settings;
			$json	= array();
			$list 	= array(
				'post_id'    	=> esc_html__('You are not allowed to perform this action', 'taskbot-api'),
				'first_name'    => esc_html__('First name is required', 'taskbot-api'),
				'last_name'    	=> esc_html__('Last name is required', 'taskbot-api'),
				'country'   	=> esc_html__('Country is required', 'taskbot-api'),
				'zipcode'    	=> esc_html__('Zip code is required', 'taskbot-api')
			);
			if (empty($taskbot_settings['enable_zipcode'])) {
				unset($list['zipcode']);
			}

			if (!empty($user_type) && $user_type === 'sellers') {
				$list['seller_type']	= esc_html__('Seller type is required', 'taskbot-api');
				$list['english_level']	= esc_html__('English level is required', 'taskbot-api');
				$list['hourly_rate']	= esc_html__('Hourly rate is required', 'taskbot-api');
			}
			foreach ($list as $meta_key => $value) {
				if (empty($request[$meta_key])) {
					$json['type'] 		    = 'error';
					$json['message_desc'] 	= esc_html($value);
					return new WP_REST_Response($json, 203);
				}
			}

			$first_name     = !empty($request['first_name']) ? sanitize_text_field($request['first_name']) : '';
			$last_name 	    = !empty($request['last_name']) ? sanitize_text_field($request['last_name']) : '';
			$tagline        = !empty($request['tagline']) ? sanitize_text_field($request['tagline']) : '';
			$country        = !empty($request['country']) ? sanitize_text_field($request['country']) : '';
			$zipcode 	    = !empty($request['zipcode']) ? sanitize_text_field($request['zipcode']) : '';

			if (!empty($user_type) && $user_type === 'sellers') {
				$seller_type 	= !empty($request['seller_type']) ? sanitize_text_field($request['seller_type']) : '';
				$english_level 	= !empty($request['english_level']) ? sanitize_text_field($request['english_level']) : '';
				$hourly_rate 	= !empty($request['hourly_rate']) ? sanitize_text_field($request['hourly_rate']) : '';
				/* update seller type term */
				if (isset($seller_type) && $seller_type != '') {
					wp_set_object_terms($profile_id, intval($seller_type), 'tb_seller_type');
				}

				/* update english level term */
				if (isset($english_level) && $english_level != '') {
					wp_set_object_terms($profile_id, intval($english_level), 'tb_english_level');
				}
				update_post_meta($profile_id, 'tb_hourly_rate', $hourly_rate);
			}

			$old_zipcode    = get_post_meta($profile_id, 'zipcode', true);
			$old_country    = get_post_meta($profile_id, 'country', true);
			$old_location   = get_post_meta($profile_id, 'location', true);
			if (empty($taskbot_settings['enable_zipcode'])) {
				update_post_meta($profile_id, 'longitude', 0);
				update_post_meta($profile_id, 'latitude', 0);
			} else if ((empty($old_zipcode) || (!empty($old_zipcode) && $old_zipcode != $zipcode))) {
				$response   = array();
				$response   = taskbot_process_geocode_info($zipcode, $country, 'yes');
				if (!empty($response['type']) && $response['type'] === 'success' && !empty($response['geo_data'])) {
					update_post_meta($profile_id, 'location', $response['geo_data']);
					update_post_meta($profile_id, '_longitude', $response['geo_data']['lng']);
					update_post_meta($profile_id, '_latitude', $response['geo_data']['lat']);
				} else if (!empty($response['type']) && $response['type'] === 'error') {
					$json['type'] 		    = 'error';
					$json['message_desc'] 	= !empty($response['message_desc']) ? esc_html($response['message_desc']) : '';
					return new WP_REST_Response($json, 203);
				}
			}

			$tb_post_meta             = get_post_meta($profile_id, 'tb_post_meta', true);
			$tb_post_meta             = !empty($tb_post_meta) ? $tb_post_meta : array();
			$full_name 		            = $first_name . ' ' . $last_name;
			$post_data                = array();
			$post_data['post_title']  = $full_name;
			$post_data['ID']          = $profile_id;
			wp_update_post($post_data);
			$tb_post_meta['first_name'] = $first_name;
			$tb_post_meta['last_name']  = $last_name;
			$tb_post_meta['tagline']    = $tagline;
			update_user_meta($user_id, 'first_name', $first_name);
			update_user_meta($user_id, 'last_name', $last_name);
			update_post_meta($profile_id, 'tb_post_meta', $tb_post_meta);
			update_post_meta($profile_id, 'country', $country);
			update_post_meta($profile_id, 'zipcode', $zipcode);
			$json['type']           = 'success';
			$json['message_desc']   = esc_html__('Your profile has been updated', 'taskbot-api');
			return new WP_REST_Response($json, 200);
		}

		/**
		 * Decline Proposal
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function declineProposal($request)
		{
			$json 	 	= array();
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response	= $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$profile_id   	= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id      	= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$detail         = !empty($request['detail']) ? sanitize_textarea_field($request['detail']) : '';
			$proposal_id    = !empty($request['proposal_id']) ? intval($request['proposal_id']) : 0;

			$list 	= array(
				'user_id'    	=> esc_html__('User id is missing', 'taskbot-api'),
				'detail'    	=> esc_html__('Decline detail is required', 'taskbot-api'),
				'proposal_id' 	=> esc_html__('Proposal id is required', 'taskbot-api'),
			);

			foreach ($list as $req_key => $value) {
				if (empty($request[$req_key])) {
					$json['type'] 		    = 'error';
					$json['message_desc'] 	= esc_html($value);
					return new WP_REST_Response($json, 203);
				}
			}

			if (!empty($user_id)) {
				$response = taskbotDeclineProposal($user_id, $proposal_id, $detail, 'mobile');
				$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
				return new WP_REST_Response($response, $response_status);
			} else {
				$json['type']			= 'error';
				$json['message_desc']	= esc_html__('User id is missing', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}

		/**
		 * Proposal price calculation
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function proposalPriceShares($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response    = $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$profile_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$price				= !empty($request['price']) ? $request['price'] : 0;

			if (!empty($profile_id) && !empty($price)) {
				taskbotPriceCalcuation($profile_id, $price);
			} else {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('You are not allowd to perfom this action', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}

		/**
		 * Add/Update job/project
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function UpdateJob($request)
		{
			global $taskbot_settings;

			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response    = $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$json 					= array();
			$profile_id				= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id				= !empty($request['user_id']) ? intval($request['user_id']) : 0;
			$project_id     		= !empty($request['project_id']) ? intval($request['project_id']) : 0;
			$step_id				= !empty($request['step_id']) ? intval($request['step_id']) : 0;

			if (empty($step_id) || ($step_id != 2 && $step_id != 3)) {
				$json['type']			= 'error';
				$json['message_desc']	= esc_html__('Step id is missing or incorrect', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			if ($step_id == 2) {
				/* 1st Step data */
				$project_title			= !empty($request['title']) ? $request['title'] : '';
				$details				= !empty($request['details']) ? $request['details'] : '';
				$project_type			= !empty($request['project_type']) ? $request['project_type'] : '';
				$min_price				= !empty($request['min_price']) ? $request['min_price'] : '';
				$max_price				= !empty($request['max_price']) ? $request['max_price'] : '';
				$categories				= !empty($request['categories']) ? $request['categories'] : '';
				$duration				= !empty($request['duration']) ? $request['duration'] : '';
				$zipcode				= !empty($request['zipcode']) ? $request['zipcode'] : '';
				$country				= !empty($request['country']) ? $request['country'] : '';
				$project_id         	= !empty($request['project_id']) ? intval($request['project_id']) : "";
				$is_milestone			= !empty($request['is_milestone']) ? $request['is_milestone'] : "no";
				$project_location		= !empty($request['location']) ? $request['location'] : '';
				$downloads           	= !empty($request['attachments']) ? json_decode(stripslashes($request['attachments']), true) : array();
				$attachment_size      	= !empty($request['attachment_size']) ? $request['attachment_size'] : 0;
				$video_url				= !empty($request['video_url']) ? $request['video_url'] : '';

				$max_hours				= !empty($request['max_hours']) ? $request['max_hours'] : '';
				$min_hourly_price		= !empty($request['min_hourly_price']) ? $request['min_hourly_price'] : '';
				$max_hourly_price		= !empty($request['max_hourly_price']) ? $request['max_hourly_price'] : '';

				/* validate received data */
				$required_fields    = array(
					'title'             => esc_html__('Project title is required', 'taskbot-api'),
					'location'          => esc_html__('Please select location', 'taskbot-api'),
					'project_type'      => esc_html__('Please select project type', 'taskbot-api'),
				);

				if (!empty($project_type) && $project_type === 'fixed') {
					$required_fields['min_price']   = esc_html__('Minimum price is required', 'taskbot-api');
					$required_fields['max_price']   = esc_html__('Maximum price is required', 'taskbot-api');
				}

				$required_fields        = apply_filters('taskbot_project_validation_step2', $required_fields, $request);
				$taskbot_validation     = !empty($taskbot_settings['project_val_step2']) ? $taskbot_settings['project_val_step2'] : array();

				if (!empty($taskbot_validation)) {
					foreach ($taskbot_validation as $value) {
						$required_fields[$value]   = taskbotProjectValidations($step_id, $value);
					}
				}

				if (!empty($request['location']) && $request['location'] === 'location') {
					if (!empty($enable_zipcode)) {
						$required_fields['zipcode']   = esc_html__('Please add the zipcode', 'taskbot-api');
					}
					$required_fields['country']   	= esc_html__('Country field is required', 'taskbot-api');
				}

				$json['message']        = esc_html__('Project step1', 'taskbot-api');

				if (!empty($required_fields)) {
					foreach ($required_fields as $key => $value) {
						if (empty($request[$key])) {
							$json['type']           = 'error';
							$json['message_desc']   = $value;
							if (empty($type)) {
								return new WP_REST_Response($json, 203);
							}
						} else if (!empty($project_type) && $project_type === 'fixed' && !empty($key) && $key === 'max_price') {
							if ($request['max_price'] <= $request['min_price']) {
								$json['type']           = 'error';
								$json['message_desc']   = esc_html__('Please add valid maximum price value', 'taskbot-api');
								if (empty($type)) {
									return new WP_REST_Response($json, 203);
								}
							}
						} else if (!empty($project_type) && $project_type === 'fixed' && !empty($key) && $key === 'min_price') {
							$projectmin_price = !empty($taskbot_settings['fixed_projectmin_price']) ? $taskbot_settings['fixed_projectmin_price'] : 5;
							if ($request['min_price'] <= $projectmin_price) {
								$json['type']           = 'error';
								$json['message_desc']   = sprintf(esc_html__('Please add minimum price is greater then %s', 'taskbot-api'), taskbot_price_format($projectmin_price, 'return'));
								if (empty($type)) {
									return new WP_REST_Response($json, 203);
								}
							}
						}
					}
				}
			} elseif ($step_id == 3) {
				/* 2nd setp data */
				$no_of_freelancers		= !empty($request['no_of_freelancers']) ? $request['no_of_freelancers'] : '';
				$skills					= !empty($request['skills']) ? $request['skills'] : array();
				$languages				= !empty($request['languages']) ? $request['languages'] : array();
				$expertise_level		= !empty($request['expertise_level']) ? $request['expertise_level'] : '';
				$required_fields    = array(
					'no_of_freelancers'     => esc_html__('Select No. of freelancers', 'taskbot-api'),
					'project_id'            => esc_html__('You are not allowed to perform this action', 'taskbot-api')
				);

				$required_fields        = apply_filters('taskbot_project_validation_step3', $required_fields);
				$taskbot_validation     = !empty($taskbot_settings['project_val_step3']) ? $taskbot_settings['project_val_step3'] : array();

				if (!empty($taskbot_validation)) {
					foreach ($taskbot_validation as $value) {
						$required_fields[$value]   = taskbotProjectValidations($step_id, $value);
					}
				}

				$required_fields        = apply_filters('taskbot_project_validation_step2', $required_fields);
				if (!empty($required_fields)) {
					foreach ($required_fields as $key => $value) {
						if (empty($request[$key])) {
							$json['type']           = 'error';
							$json['message_desc']   = $value;
							if (empty($type)) {
								return new WP_REST_Response($json, 203);
							}
						}
					}
				}
			}

			$response 			= taskbotSaveProjectData($request, 'mobile');
			$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
			return new WP_REST_Response($response, $response_status);
		}

		/**
		 * Use template for project creation
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function useProjectTemplate($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response    = $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$project_id   	= !empty($request['project_id']) ? $request['project_id'] : 0;
			$user_id       	= !empty($request['user_id']) ? $request['user_id'] : 0;

			if (!empty($project_id) && !empty($user_id)) {
				$response = taskbotDuplicateProject($project_id, $user_id, 'mobile');
				$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
				return new WP_REST_Response($response, $response_status);
			} else {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('You are not allowd to perfom this action', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}

		/**
		 * invite freelancer for bidding on project
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function inviteToBidProject($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);

			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$response    = $this->taskbotAuthentication($request);
			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			$profile_id   	= !empty($request['post_id']) ? $request['post_id'] : 0; /* profile id */
			$project_id   	= !empty($request['project_id']) ? $request['project_id'] : 0;
			$user_id       	= !empty($request['user_id']) ? $request['user_id'] : 0;

			if (empty($project_id)) {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('Project id is missing!', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			$response = taskbotInvitationProject($project_id, $profile_id, $user_id, 'mobile');
			$response_status	= !empty($response['type']) && $response['type'] === 'error' ? 203 : 200;
			return new WP_REST_Response($response, $response_status);
		}

		/**
		 * Get all tags of product post type
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function getAllTags($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);

			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			if (!class_exists('WooCommerce')) {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('Woocommerce is not activated!', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			$product_tags_array 	= array();
			$product_tags 			= get_terms(array(
				'taxonomy' 		=> 'product_tag',
				'hide_empty' 	=> false
			));
			if (!empty($product_tags) && !is_wp_error($product_tags)) {
				foreach ($product_tags as $product_tag) {
					$product_tags_array[] = array(
						'id' 		=> $product_tag->term_id,
						'name' 		=> $product_tag->name,
						'slug' 		=> $product_tag->slug,
					);
				}
			}

			if (!empty($product_tags_array)) {
				return new WP_REST_Response($product_tags_array, 200);
			} else {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('No record found', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}

		/**
		 * Get all tags of product post type
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		function getAllAddons($request)
		{
			if (!class_exists('WooCommerce')) {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('Woocommerce is not activated!', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			$profile_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$user_id         	= !empty($request['user_id']) ?  intval($request['user_id']) : 0;
			$type               = !empty($request['type']) ?  $request['type'] : 'all';

			if ($type == 'all') {
				$args = array(
					'limit'     => -1,
					'status'    => 'publish',
					'type'      => 'subtasks',
					'orderby'   => 'date',
					'order'     => 'DESC',
					'author'    => $user_id
				);
			}

			$taskbot_subtasks = wc_get_products($args);
			if (!empty($taskbot_subtasks)) {
				foreach ($taskbot_subtasks as $subtask) {
					$addon_arr[] = array(
						'id' 				=> $subtask->get_id(),
						'name' 				=> $subtask->get_name(),
						'price' 			=> $subtask->get_price(),
						'price_formated' 	=> taskbot_price_format($subtask->get_price(), 'return', true),
					);
				}
				return new WP_REST_Response($addon_arr, 200);
			} else {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('No record found', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}

		/**
		 * Recommended freelancers
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function recommendedFreelancers($request)
		{
			$response	= $this->taskbot_is_mobile_demo_site($request);

			if (!empty($response) && $response['type'] == 'error') {
				return new WP_REST_Response($response, 203);
			}

			if (!class_exists('WooCommerce')) {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('Woocommerce is not activated!', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}

			global $taskbot_settings;
			$recommended_data 	= array();
			$profile_id			= !empty($request['post_id']) ? intval($request['post_id']) : 0; /* profile id */
			$project_id			= !empty($request['project_id']) ? intval($request['project_id']) : 0;
			$options            = !empty($taskbot_settings['project_recomended_freelancers']) ? $taskbot_settings['project_recomended_freelancers'] : array();
			$pg_paged           = !empty($request['paged']) ? $request['paged'] : 1;
			$per_page           = !empty($request['per_page']) ? $request['per_page'] : 10;

			$tax_query_args     = array();
			if (!empty($options)) {
				foreach ($options as $option) {
					$term_obj           = get_the_terms($project_id, $option);
					$term_slug          = !empty($term_obj) ? wp_list_pluck($term_obj, 'slug') : array();

					$tax_query_args[]   = array(
						'taxonomy' => $option,
						'field'    => 'slug',
						'terms'    => $term_slug,
						'operator' => 'IN',
					);
				}
			}

			$query_args = array(
				'posts_per_page'        => $per_page,
				'paged'                 => $pg_paged,
				'post_type'             => 'sellers',
				'post_status'           => 'publish',
				'ignore_sticky_posts'   => 1
			);

			if (!empty($tax_query_args)) {
				$query_relation           = array('relation' => 'OR',);
				$tax_query_args           = array_merge($query_relation, $tax_query_args);
				$query_args['tax_query']  = $tax_query_args;
			}

			$seller_data = new WP_Query(apply_filters('taskbot_api_recomended_freelancer_filter', $query_args));
			$total_posts = $seller_data->found_posts;

			if ($seller_data->have_posts() && $total_posts > 0) {
				while ($seller_data->have_posts()) {
					$seller_data->the_post();
					$seller_id        = get_the_ID();
					$seller_name      = taskbot_get_username($seller_id);
					$tb_post_meta     = get_post_meta($seller_id, 'tb_post_meta', true);
					$seller_tagline   = !empty($tb_post_meta['tagline']) ? $tb_post_meta['tagline'] : '';
					//Ratings
					$user_rating                = get_post_meta($seller_id, 'tb_total_rating', true);
					$user_rating                = !empty($user_rating) ? $user_rating : 0;
					$review_users               = get_post_meta($seller_id, 'tb_review_users', true);
					$review_users               = !empty($review_users) ? intval($review_users) : 0;
					//Views
					$taskbot_freelancer_views = get_post_meta($seller_id, 'taskbot_profile_views', TRUE);
					$taskbot_freelancer_views = !empty($taskbot_freelancer_views) ? intval($taskbot_freelancer_views) : 0;

					$avatar         = apply_filters(
						'taskbot_avatar_fallback',
						taskbot_get_user_avatar(array('width' => 200, 'height' => 200), $seller_id),
						array('width' => 200, 'height' => 200)
					);

					/* rating */
					$rating_data = array(
						'rating' 	=> number_format($user_rating, 1, '.', ''),
						'reviews'	=> $review_users,
					);

					$recommended_data[] = array(
						'seller_id' 	=> $seller_id,
						'seller_name' 	=> $seller_name,
						'tagline' 		=> $seller_tagline,
						'image' 		=> $avatar,
						'rating_data' 	=> $rating_data,
						'views' 		=> $taskbot_freelancer_views,
					);
				}

				$json['type']           = 'success';
				$json['recommended']   = $recommended_data;
				return new WP_REST_Response($json, 200);
			} else {
				$json['type']           = 'error';
				$json['message_desc']   = esc_html__('No recommended freelancers found.', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}


		/**
		 * Login user 
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function userAuth($request)
		{
			$json 			= $userInfo = array();
			$username		= !empty($request['username']) ? $request['username'] : '';
			$userpassword	= !empty($request['userpassword'])  ? $request['userpassword']  : '';

			if (!empty($username) && !empty($userpassword)) {

				$creds = array(
					'user_login' 			=> $username,
					'user_password' 		=> $userpassword,
					'remember' 				=> true
				);

				$user = wp_signon($creds, false);

				if (is_wp_error($user)) {
					$json['type']			= 'error';
					$json['message_desc']	= esc_html__('Some error occur, please try again later.', 'taskbot-api');
					return new WP_REST_Response($json, 203);
				} else {

					unset($user->allcaps);
					unset($user->filter);
					$userInfo               = array();

					$user_type              = apply_filters('taskbot_get_user_type', $user->data->ID);
					$profile_id             = apply_filters('taskbot_get_linked_profile_id', $user->data->ID, '', $user_type);
					$authToken 				= $this->getTaskbotAuthToken($profile_id);

					if (function_exists('taskbot_get_user_basic')) {
						$userInfo	= taskbot_get_user_basic($profile_id, $user->data->ID);
					}
					$settings		 		= taskbot_get_account_settings($user_type);
					if (!empty($settings)) {
						foreach ($settings as $key => $val) {
							$db_val 	= get_post_meta($profile_id, $key, true);
							$db_val 	= !empty($db_val) ?  $db_val : 'off';
							$userInfo['settings'][$key]	= $db_val;
						}
					}
					$userInfo['user_type']	= $user_type;
					$json['type']			= 'success';
					$json['message_desc'] 		= esc_html__('Successfully logged in', 'taskbot-api');
					$json['userdetails'] 	= $userInfo;
					$json['authToken'] 		= $authToken;
					return new WP_REST_Response($json, 200);
				}
			} else {
				$json['type']		= 'error';
				$json['message_desc']	= esc_html__('user name and password are required fields.', 'taskbot-api');
				return new WP_REST_Response($json, 203);
			}
		}

		/**
		 * Get guppy auth token
		 *
		 * @since    1.0.0
		 */
		public function getTaskbotAuthToken($post_id)
		{
			$issuedAt 	= time();
			$notBefore 	= $issuedAt + 10;
			$expire 	= $issuedAt + (DAY_IN_SECONDS * 90);
			// $expire 	= $issuedAt + 18000; // will expire in 5 hours
			$token = array(
				'iss' => get_bloginfo('url'),
				'iat' => $issuedAt,
				'nbf' => $notBefore,
				'exp' => $expire,
				'data' => array(
					'user' => array(
						'post_id' => $post_id,
					),
				),
			);
			$jwt = JWT::encode($token, $this->secretKey, 'HS256');
			return $jwt;
		}

		/**
		 * Authentication
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|WP_REST_Request
		 */
		public function taskbotAuthentication($data)
		{
			$headers    = $data->get_headers();
			$params     = !empty($data->get_params()) 		? $data->get_params() 		: '';
			$authtoken  = !empty($headers['authorization'][0]) ? $headers['authorization'][0] : '';
			$json 		= array();
			$type 		= 'success';
			$message 	= '';
			if (empty($params['post_id'])) {
				$message   	= esc_html__('You are not allowed to perform this action!', 'taskbot-api');
				$type 		= 'error';
			} else {
				list($token) = sscanf($authtoken, 'Bearer %s');
				if (!$token) {
					$message   	= esc_html__('Authorization Token does not found!', 'taskbot-api');
					$type 		= 'error';
				} else {

					try {
						JWT::$leeway = 60;
						$token 	= JWT::decode($token, new Key($this->secretKey, 'HS256'));
						$now 	= time();
						if (
							$token->iss != get_bloginfo('url')
							|| !isset($token->data->user->post_id)
							|| $token->data->user->post_id != $params['post_id']
							|| $token->exp < $now
						) {
							$message   	= esc_html__('You are not allowed to perform this action!', 'taskbot-api');
							$type 		= 'error';
						}
					} catch (Exception $e) {
						$message   	= $e->getMessage();
						$type 		= 'error';
					}
				}
			}
			$json['type'] 			= $type;
			$json['message_desc']   = $message;
			return $json;
		}
	}

	add_action('rest_api_init', function () {
		$controller = new TaskbotApiTaskbot;
		$controller->register_routes();
	});
}
