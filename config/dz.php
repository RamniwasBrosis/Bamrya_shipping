<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Application Name
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	'name' => env('APP_NAME', 'W3crm Admin Laravel'),


	'public' => [
		'global' => [
			'css' => [
				'vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				'css/style.css',
			],

			'js' => [
				'top'=> [
					'vendor/global/global.min.js',
					'vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
					
				],
				'bottom'=> [
					'js/custom.min.js',
					'js/deznav-init.js',
				],
			],
		],
		'pagelevel' => [
			'css' => [
				'W3crmAdminController_dashboard' => [
                    'vendor/swiper/css/swiper-bundle.min.css',
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'vendor/jvmap/jquery-jvectormap.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
				'W3crmAdminController_dashboard_2' => [
                    'vendor/swiper/css/swiper-bundle.min.css',
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'vendor/jvmap/jquery-jvectormap.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
				'W3crmAdminController_employee' => [
                    'vendor/swiper/css/swiper-bundle.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
				'W3crmAdminController_core_hr' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/clockpicker/css/bootstrap-clockpicker.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
				'W3crmAdminController_finance' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
				'W3crmAdminController_task' => [
                    'vendor/swiper/css/swiper-bundle.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
				'W3crmAdminController_task_summary' => [
                    'vendor/swiper/css/swiper-bundle.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
                'W3crmAdminController_performance' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
                'W3crmAdminController_project' => [
                    'vendor/swiper/css/swiper-bundle.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
                'W3crmAdminController_reports' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
                'W3crmAdminController_manage_client' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
                'W3crmAdminController_blog_1' => [
				],
                'W3crmAdminController_svg_icon' => [
				],
                'W3crmAdminController_chat' => [
                    'vendor/dropzone/dist/dropzone.css',
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css',
				],
                'W3crmAdminController_user' => [
                    'vendor/swiper/css/swiper-bundle.min.css',
	                'https://fonts.googleapis.com/css2?family=Material+Icons',
	                'vendor/datatables/css/jquery.dataTables.min.css',
				],
                'W3crmAdminController_edit_profile' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'vendor/jvmap/jquery-jvectormap.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
				],
                 'W3crmAdminController_user_roles' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                ],
                'W3crmAdminController_add_role' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                ],
                'W3crmAdminController_app_profile_1' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/lightgallery/css/lightgallery.min.css',
				],
                'W3crmAdminController_app_profile_2' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/lightgallery/css/lightgallery.min.css',
				],
                'W3crmAdminController_app_profile' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/lightgallery/css/lightgallery.min.css',
				],
                'W3crmAdminController_post_details' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/lightgallery/css/lightgallery.min.css',
				],
                'W3crmAdminController_customer' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
                'W3crmAdminController_customer_profile' => [
                    'vendor/swiper/css/swiper-bundle.min.css',
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'vendor/jvmap/jquery-jvectormap.css',
                    'vendor/tagify/dist/tagify.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
				],
                'W3crmAdminController_contacts' => [
                    'vendor/swiper/css/swiper-bundle.min.css',
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/tagify/dist/tagify.css',
				],
				'W3crmAdminController_email_compose' => [
                    'vendor/dropzone/dist/dropzone.css',
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
                    'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css',
				],
				'W3crmAdminController_email_read' => [
                    'vendor/dropzone/dist/dropzone.css',
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css',
				],
				'W3crmAdminController_email_inbox' => [
                    'vendor/dropzone/dist/dropzone.css',
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css',
				 ],
                 'W3crmAdminController_app_calender' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/fullcalendar/css/main.min.css',
				 ],
                 'W3crmAdminController_ecom_product_grid' => [
				],
				'W3crmAdminController_ecom_product_list' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/star-rating/star-rating-svg.css',
				],
				'W3crmAdminController_ecom_product_detail' => [
                    'vendor/star-rating/star-rating-svg.css',
				],
				'W3crmAdminController_ecom_product_order' => [
				],
				'W3crmAdminController_ecom_checkout' => [
				],
				'W3crmAdminController_ecom_invoice' => [
                    'vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'W3crmAdminController_ecom_customers' => [
				],

				'W3crmAdminController_chart_flot' => [
				],
				'W3crmAdminController_chart_morris' => [
				],
				'W3crmAdminController_chart_chartjs' => [
				],
				'W3crmAdminController_chart_chartist' => [
                    'vendor/chartist/css/chartist.min.css',
				],
				'W3crmAdminController_chart_sparkline' => [
				],
				'W3crmAdminController_chart_peity' => [
				],

				'W3crmAdminController_ui_accordion' => [
				],
				'W3crmAdminController_ui_alert' => [
				],
				'W3crmAdminController_ui_badge' => [
				],
				'W3crmAdminController_ui_button' => [
				],
				'W3crmAdminController_ui_button_group' => [
				],
				'W3crmAdminController_ui_card' => [

				],
				'W3crmAdminController_ui_carousel' => [
				],
				'W3crmAdminController_ui_dropdown' => [
				],

				'W3crmAdminController_ui_list_group' => [
				],
				'W3crmAdminController_ui_media_object' => [
				],
				'W3crmAdminController_ui_modal' => [
				],
				'W3crmAdminController_ui_pagination' => [
				],
				'W3crmAdminController_ui_popover' => [
				],
				'W3crmAdminController_ui_progressbar' => [
				],
				'W3crmAdminController_ui_tab' => [
				],
				'W3crmAdminController_ui_typography' => [
				],
				'W3crmAdminController_ui_grid' => [
				],
				'W3crmAdminController_uc_select2' => [
					'vendor/select2/css/select2.min.css',
				],
				'W3crmAdminController_uc_nestable' => [
                    'vendor/nestable2/css/jquery.nestable.min.css',
				],
				'W3crmAdminController_uc_noui_slider' => [
                    'vendor/nouislider/nouislider.min.css',
				],
				'W3crmAdminController_uc_sweetalert' => [
                    'vendor/sweetalert2/dist/sweetalert2.min.css',
				],
				'W3crmAdminController_uc_toastr' => [
                    'vendor/toastr/css/toastr.min.css',
				],
				'W3crmAdminController_map_jqvmap' => [
                    'vendor/jqvmap/css/jqvmap.min.css',
				],
				'W3crmAdminController_uc_lightgallery' => [
                    'vendor/lightgallery/css/lightgallery.min.css',
				],
				'W3crmAdminController_widget_basic' => [
                    'vendor/chartist/css/chartist.min.css',
                    'vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
				],
				'W3crmAdminController_form_element' => [
				],
				'W3crmAdminController_form_wizard' => [
                    'vendor/jquery-smartwizard/dist/css/smart_wizard.min.css',
				],
				'W3crmAdminController_form_ckeditor' => [
				],
				'W3crmAdminController_form_pickers' => [
                    'vendor/bootstrap-daterangepicker/daterangepicker.css',
                    'vendor/clockpicker/css/bootstrap-clockpicker.min.css',
                    'vendor/jquery-asColorPicker/css/asColorPicker.min.css',
                    'vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
                    'vendor/pickadate/themes/default.css',
                    'vendor/pickadate/themes/default.date.css',
                    'https://fonts.googleapis.com/icon?family=Material+Icons',
				],
				'W3crmAdminController_form_validation' => [
				],
				'W3crmAdminController_table_bootstrap_basic' => [
				],
				'W3crmAdminController_table_datatable_basic' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
				],
				'W3crmAdminController_page_login' => [
				],
				'W3crmAdminController_page_register' => [
				],
				'W3crmAdminController_page_error_400' => [
				],
				'W3crmAdminController_page_error_403' => [
				],
				'W3crmAdminController_page_error_404' => [
				],
				'W3crmAdminController_page_error_500' => [
				],
				'W3crmAdminController_page_error_503' => [
				],
				'W3crmAdminController_empty_page' => [
				],
				'W3crmAdminController_page_lock_screen' => [
				],
                'W3crmAdminController_content' => [
                    'vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
				],
                'W3crmAdminController_content_add' => [
                    'vendor/select2/css/select2.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
				],
                'W3crmAdminController_menu' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'vendor/nestable2/css/jquery.nestable.min.css',
				],
                'W3crmAdminController_email_template' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                ],
                'W3crmAdminController_add_email' => [
                    'vendor/select2/css/select2.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                ],
                'W3crmAdminController_blog' => [
                    'vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                ],
                'W3crmAdminController_add_blog' => [
                    'vendor/select2/css/select2.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                ],
                'W3crmAdminController_blog_category' => [
                    'vendor/datatables/css/jquery.dataTables.min.css',
                ],
                'W3crmAdminController_auto_write' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                ],
                'W3crmAdminController_scheduled' => [
                    'vendor/swiper/css/swiper-bundle.min.css',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                    'vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
                    'vendor/tagify/dist/tagify.css',
                ],
                'W3crmAdminController_setting' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/nouislider/nouislider.min.css',
                    'vendor/clockpicker/css/bootstrap-clockpicker.min.css',
                    'vendor/jquery-asColorPicker/css/asColorPicker.min.css',
                    'vendor/tagify/dist/tagify.css',
                    'vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
                ],
                'W3crmAdminController_rss' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                ],
                'W3crmAdminController_repurpose' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                ],
                'W3crmAdminController_chatpot' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/nouislider/nouislider.min.css',
                    'vendor/clockpicker/css/bootstrap-clockpicker.min.css',
                    'vendor/jquery-asColorPicker/css/asColorPicker.min.css',
                    'vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
                ],
                'W3crmAdminController_fine_tune_models' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/datatables/css/jquery.dataTables.min.css',
                    'https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css',
                ],
                'W3crmAdminController_prompt' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
	                'vendor/nouislider/nouislider.min.css',
                ],
                'W3crmAdminController_import' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/dropzone/dist/dropzone.css',
                ],

			],
			'js' => [
				'W3crmAdminController_dashboard' => [
                        'vendor/chart.js/Chart.bundle.min.js',
                        'vendor/apexchart/apexchart.js',
                        'js/dashboard/dashboard-1.js',
                        'vendor/draggable/draggable.js',
                        'vendor/tagify/dist/tagify.js',
                        'vendor/datatables/js/jquery.dataTables.min.js',
                        'vendor/datatables/js/dataTables.buttons.min.js',
                        'vendor/datatables/js/buttons.html5.min.js',
                        'vendor/datatables/js/jszip.min.js',
                        'js/plugins-init/datatables.init.js',
                        'vendor/bootstrap-datetimepicker/js/moment.js',
                        'vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
                        'vendor/jqvmap/js/jquery.vmap.min.js',
                        'vendor/jqvmap/js/jquery.vmap.world.js',
                        'vendor/jqvmap/js/jquery.vmap.usa.js',

				],
				'W3crmAdminController_dashboard_2' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                        'vendor/apexchart/apexchart.js',
                        'js/dashboard/dashboard-1.js',
                        'vendor/draggable/draggable.js',
                        'vendor/tagify/dist/tagify.js',
                        'vendor/datatables/js/jquery.dataTables.min.js',
                        'vendor/datatables/js/dataTables.buttons.min.js',
                        'vendor/datatables/js/buttons.html5.min.js',
                        'vendor/datatables/js/jszip.min.js',
                        'js/plugins-init/datatables.init.js',
                        'vendor/bootstrap-datetimepicker/js/moment.js',
                        'vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
                        'vendor/jqvmap/js/jquery.vmap.min.js',
                        'vendor/jqvmap/js/jquery.vmap.world.js',
                        'vendor/jqvmap/js/jquery.vmap.usa.js',
				],
				'W3crmAdminController_employee' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/apexchart/apexchart.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                    'vendor/tagify/dist/tagify.js',
				],
				'W3crmAdminController_core_hr' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/clockpicker/js/bootstrap-clockpicker.min.js',
                    'vendor/apexchart/apexchart.js',
                    'js/plugins-init/clock-picker-init.js',
                    'vendor/tagify/dist/tagify.js',
                    'js/dashboard/core-hr.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                    'vendor/dropzone/dist/dropzone.js',
                    'vendor/bootstrap-datetimepicker/js/moment.js',
                    'vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
				],
				'W3crmAdminController_finance' => [
                    'vendor/tagify/dist/tagify.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                    'vendor/bootstrap-datetimepicker/js/moment.js',
                    'vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',

				],
				'W3crmAdminController_task' => [
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                    'vendor/tagify/dist/tagify.js',
				],
				'W3crmAdminController_task_summary' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/draggable/draggable.js',
                    'vendor/tagify/dist/tagify.js',
				],
                'W3crmAdminController_performance' => [
                    'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'js/plugins-init/datatables.init.js',
                    'vendor/tagify/dist/tagify.js',
                    'vendor/bootstrap-datetimepicker/js/moment.js',
                    'vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
				],
                'W3crmAdminController_project' => [
                    'vendor/tagify/dist/tagify.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
				],
                'W3crmAdminController_reports' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                    'vendor/tagify/dist/tagify.js',
                    'vendor/bootstrap-datetimepicker/js/moment.js',
                    'vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
                ],
                'W3crmAdminController_manage_client' =>[
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                'vendor/tagify/dist/tagify.js',
                    'vendor/bootstrap-datetimepicker/js/moment.js',
                    'vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
                ],
                'W3crmAdminController_blog_1' => [
				],
                'W3crmAdminController_svg_icon' => [
				],
                'W3crmAdminController_chat' => [
                    'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
	                'vendor/dropzone/dist/dropzone.js',
				],
                'W3crmAdminController_user' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/apexchart/apexchart.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
				],
                'W3crmAdminController_edit_profile' => [
                    'vendor/chart.js/Chart.bundle.min.js',
	                'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
                ],
                'W3crmAdminController_user_roles' => [
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'js/plugins-init/datatables.init.js',
                ],
                'W3crmAdminController_add_role' => [
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'js/plugins-init/datatables.init.js',
                ],
                'W3crmAdminController_app_profile_1' => [
                    'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
                    'vendor/lightgallery/js/lightgallery-all.min.js',

				],'W3crmAdminController_app_profile_2' => [
                    'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
                    'vendor/lightgallery/js/lightgallery-all.min.js',

				],'W3crmAdminController_app_profile' => [
                    'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
                    'vendor/lightgallery/js/lightgallery-all.min.js',
				],
                'W3crmAdminController_post_details' => [
                    'vendor/lightgallery/js/lightgallery-all.min.js',
                    'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
                ],
                'W3crmAdminController_customer' => [
                    'vendor/apexchart/apexchart.js',
                    'vendor/tagify/dist/tagify.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                    'vendor/bootstrap-datetimepicker/js/moment.js',
                    'vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
				],
                'W3crmAdminController_customer_profile' => [
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/tagify/dist/tagify.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                    'vendor/bootstrap-datetimepicker/js/moment.js',
                    'vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
				],
                'W3crmAdminController_contacts' => [
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                    'vendor/tagify/dist/tagify.js',
				],
				'W3crmAdminController_email_compose' => [
                    'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
                    'vendor/dropzone/dist/dropzone.js',
				],
				'W3crmAdminController_email_read' => [
                    'vendor/jquery-nice-select/js/jquery.nice-select.min.js',
	                'vendor/dropzone/dist/dropzone.js',
				],
				'W3crmAdminController_email_inbox' => [
                    'vendor/dropzone/dist/dropzone.js',
				 ],
                 'W3crmAdminController_app_calender' => [
                    'vendor/moment/moment.min.js',
                    'vendor/fullcalendar/js/main.min.js',
                    'js/plugins-init/fullcalendar-init.js',

				 ],
                 'W3crmAdminController_ecom_product_grid' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
				],
				'W3crmAdminController_ecom_product_list' => [
                    'vendor/star-rating/jquery.star-rating-svg.js',
				],
				'W3crmAdminController_ecom_product_detail' => [
                    'https://fonts.googleapis.com/css2?family=Material+Icons',
                    'vendor/star-rating/jquery.star-rating-svg.js',
				],
				'W3crmAdminController_ecom_product_order' => [
				],
				'W3crmAdminController_ecom_checkout' => [
				],
				'W3crmAdminController_ecom_invoice' => [
				],
				'W3crmAdminController_ecom_customers' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/apexchart/apexchart.js',
                    'vendor/highlightjs/highlight.pack.min.js',
				],
                'W3crmAdminController_chart_flot' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/apexchart/apexchart.js',
                    'vendor/flot/jquery.flot.js',
                    'vendor/flot/jquery.flot.pie.js',
                    'vendor/flot/jquery.flot.resize.js',
                    'vendor/flot-spline/jquery.flot.spline.min.js',
                    'js/plugins-init/flot-init.js',
				],
				'W3crmAdminController_chart_morris' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/apexchart/apexchart.js',
                    'vendor/raphael/raphael.min.js',
                    'vendor/morris/morris.min.js',
                    'js/plugins-init/morris-init.js',
				],
				'W3crmAdminController_chart_chartjs' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'js/plugins-init/chartjs-init.js',
				],
				'W3crmAdminController_chart_chartist' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/apexchart/apexchart.js',
                    'vendor/chartist/js/chartist.min.js',
                    'vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
                    'js/plugins-init/chartist-init.js',
				],
				'W3crmAdminController_chart_sparkline' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/apexchart/apexchart.js',
                    'vendor/jquery-sparkline/jquery.sparkline.min.js',
                    'js/plugins-init/sparkline-init.js',
                    'vendor/svganimation/vivus.min.js',
                    'vendor/svganimation/svg.animation.js',
				],
				'W3crmAdminController_chart_peity' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/peity/jquery.peity.min.js',
                    'js/plugins-init/piety-init.js',
				],
				'W3crmAdminController_ui_accordion' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_alert' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_badge' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_button' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_button_group' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_card' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_carousel' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_dropdown' => [
                    'js/highlight.min.js',
				],

				'W3crmAdminController_ui_list_group' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_media_object' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_modal' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_pagination' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_popover' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_progressbar' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_tab' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_typography' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_ui_grid' => [
                    'js/highlight.min.js',
				],




				'W3crmAdminController_uc_select2' => [
                    'vendor/select2/js/select2.full.min.js',
                    'js/plugins-init/select2-init.js',
				],
				'W3crmAdminController_uc_nestable' => [
                    'vendor/nestable2/js/jquery.nestable.min.js',
                    'js/plugins-init/nestable-init.js',
				],
				'W3crmAdminController_uc_noui_slider' => [
                    'vendor/nouislider/nouislider.min.js',
                    'vendor/wnumb/wNumb.js',
                    'js/plugins-init/nouislider-init.js',
				],
				'W3crmAdminController_uc_sweetalert' => [
                    'vendor/sweetalert2/dist/sweetalert2.min.js',
                    'js/plugins-init/sweetalert.init.js',
				],
				'W3crmAdminController_uc_toastr' => [
                    'vendor/toastr/js/toastr.min.js',
                    'js/plugins-init/toastr-init.js',
				],
				'W3crmAdminController_map_jqvmap' => [
                    'vendor/jqvmap/js/jquery.vmap.min.js',
                    'vendor/jqvmap/js/jquery.vmap.world.js',
                    'vendor/jqvmap/js/jquery.vmap.usa.js',
                    'js/plugins-init/jqvmap-init.js',
				],
				'W3crmAdminController_uc_lightgallery' => [
                    'vendor/lightgallery/js/lightgallery-all.min.js',
				],
				'W3crmAdminController_widget_basic' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/apexchart/apexchart.js',
                    'vendor/chartist/js/chartist.min.js',
                    'vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
                    'vendor/flot/jquery.flot.js',
                    'vendor/flot/jquery.flot.pie.js',
                    'vendor/flot/jquery.flot.resize.js',
                    'vendor/flot-spline/jquery.flot.spline.min.js',
                    'vendor/jquery-sparkline/jquery.sparkline.min.js',
                    'js/plugins-init/sparkline-init.js',
                    'vendor/peity/jquery.peity.min.js',
                    'js/plugins-init/piety-init.js',
                    'js/plugins-init/widgets-script-init.js',
				],
				'W3crmAdminController_form_element' => [
				],
				'W3crmAdminController_form_wizard' => [
                    'vendor/jquery-steps/build/jquery.steps.min.js',
                    'vendor/jquery-validation/jquery.validate.min.js',
                    'js/plugins-init/jquery.validate-init.js',
                    'vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js',
				],
				'W3crmAdminController_form_ckeditor' => [
                    'vendor/ckeditor/ckeditor.js',
				],
				'W3crmAdminController_form_pickers' => [
                    'vendor/moment/moment.min.js',
                    // 'vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/apexchart/apexchart.js',
                    'vendor/moment/moment.min.js',
                    'vendor/bootstrap-daterangepicker/daterangepicker.js',
                    'vendor/clockpicker/js/bootstrap-clockpicker.min.js',
                    'vendor/jquery-asColor/jquery-asColor.min.js',
                    'vendor/jquery-asGradient/jquery-asGradient.min.js',
                    'vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js',
                    'vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
                    'vendor/pickadate/picker.js',
                    'vendor/pickadate/picker.time.js',
                    'vendor/pickadate/picker.date.js',
                    'js/plugins-init/bs-daterange-picker-init.js',

                    'js/plugins-init/clock-picker-init.js',

                    'js/plugins-init/jquery-asColorPicker.init.js',

                    'js/plugins-init/material-date-picker-init.js',

                    'js/plugins-init/pickadate-init.js',
				],
				'W3crmAdminController_form_validation' => [
				],
				'W3crmAdminController_table_bootstrap_basic' => [
                    'js/highlight.min.js',
				],
				'W3crmAdminController_table_datatable_basic' => [
                    'vendor/chart.js/Chart.bundle.min.js',
                    'vendor/apexchart/apexchart.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'js/plugins-init/datatables.init.js',
                    'js/highlight.min.js',
				],
				'W3crmAdminController_page_login' => [
				],
				'W3crmAdminController_page_register' => [
				],
				'W3crmAdminController_page_error_400' => [
				],
				'W3crmAdminController_page_error_403' => [
				],
				'W3crmAdminController_page_error_404' => [
				],
				'W3crmAdminController_page_error_500' => [
				],
				'W3crmAdminController_page_error_503' => [
				],
				'W3crmAdminController_empty_page' => [
				],
				'W3crmAdminController_page_lock_screen' => [
				],
                'W3crmAdminController_content' => [
                    'vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js',
                    'js/dashboard/cms.js',
				],
                'W3crmAdminController_content_add' => [
                    'vendor/select2/js/select2.full.min.js',
                    'js/plugins-init/select2-init.js',
                    'vendor/ckeditor/ckeditor.js',
                    'js/dashboard/cms.js',
				],
                'W3crmAdminController_menu' => [
                    'js/dashboard/cms.js',
                    'vendor/nestable2/js/jquery.nestable.min.js',
                    'js/plugins-init/nestable-init.js',
				],
                'W3crmAdminController_email_template' => [
                    'js/dashboard/cms.js',
                ],
                'W3crmAdminController_add_email' => [
                    'js/dashboard/cms.js',
                    'vendor/ckeditor/ckeditor.js',
                    'vendor/select2/js/select2.full.min.js',
                    'js/plugins-init/select2-init.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'js/plugins-init/datatables.init.js',
                ],
                'W3crmAdminController_blog' => [
                    'vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js',
                    'js/dashboard/cms.js',
                ],
                'W3crmAdminController_add_blog' => [
                    'js/dashboard/cms.js',
                    'vendor/ckeditor/ckeditor.js',
                    'vendor/select2/js/select2.full.min.js',
                    'js/plugins-init/select2-init.js',
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'js/plugins-init/datatables.init.js',
                ],
                'W3crmAdminController_blog_category' => [
                    'js/dashboard/cms.js',
                ],
                'W3crmAdminController_auto_write' => [
                    'js/dashboard/cms.js',
                ],
                'W3crmAdminController_scheduled' => [
                   'vendor/chart.js/Chart.bundle.min.js',
                   'vendor/apexchart/apexchart.js',
                   'vendor/datatables/js/jquery.dataTables.min.js',
                   'vendor/datatables/js/dataTables.buttons.min.js',
                   'vendor/datatables/js/buttons.html5.min.js',
                   'vendor/datatables/js/jszip.min.js',
                   'js/plugins-init/datatables.init.js',
                   'vendor/tagify/dist/tagify.js',
                ],
                'W3crmAdminController_setting' => [
                    'vendor/nouislider/nouislider.min.js',
                    'vendor/wnumb/wNumb.js',
                    'vendor/jquery-asColor/jquery-asColor.min.js',
                    'vendor/jquery-asGradient/jquery-asGradient.min.js',
                    'vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js',
                    'js/plugins-init/jquery-asColorPicker.init.js',
                    'vendor/tagify/dist/tagify.js',
                ],
                'W3crmAdminController_rss' => [
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                ],
                'W3crmAdminController_repurpose' => [
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                ],
                'W3crmAdminController_chatpot' => [
                    'vendor/nouislider/nouislider.min.js',
                    'vendor/wnumb/wNumb.js',
                    'vendor/jquery-asColor/jquery-asColor.min.js',
                    'vendor/jquery-asGradient/jquery-asGradient.min.js',
                    'vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js',
                    'js/plugins-init/jquery-asColorPicker.init.js',
                ],
                'W3crmAdminController_fine_tune_models' => [
                    'vendor/datatables/js/jquery.dataTables.min.js',
                    'vendor/datatables/js/dataTables.buttons.min.js',
                    'vendor/datatables/js/buttons.html5.min.js',
                    'vendor/datatables/js/jszip.min.js',
                    'js/plugins-init/datatables.init.js',
                ],
                'W3crmAdminController_prompt' => [
                    'vendor/nouislider/nouislider.min.js',
                    'vendor/wnumb/wNumb.js',
                ],
                'W3crmAdminController_import' => [
                    'vendor/dropzone/dist/dropzone.js',
                ],
			]
		],
	]
];
