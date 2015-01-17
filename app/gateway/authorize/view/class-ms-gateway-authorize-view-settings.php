<?php

class MS_Gateway_Authorize_View_Settings extends MS_View {

	public function to_html() {
		$fields = $this->prepare_fields();
		$gateway = $this->data['model'];

		ob_start();
		// Render tabbed interface.
		?>
		<div class="ms-wrap">
			<form class="ms-gateway-setings-form ms-form wpmui-ajax-update" data-ajax="<?php echo esc_attr( $gateway->id ); ?>">
				<?php
				foreach ( $fields as $field ) {
					MS_Helper_Html::html_element( $field );
				}
				?>
			</form>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}

	protected function prepare_fields() {
		$gateway = $this->data['model'];
		$action = MS_Controller_Gateway::AJAX_ACTION_UPDATE_GATEWAY;
		$nonce = wp_create_nonce( $action );

		$fields = array(
			'mode' => array(
				'id' => 'mode',
				'title' => __( 'Mode', MS_TEXT_DOMAIN ),
				'type' => MS_Helper_Html::INPUT_TYPE_SELECT,
				'value' => $gateway->mode,
				'field_options' => $gateway->get_mode_types(),
			),

			'api_login_id' => array(
				'id' => 'api_login_id',
				'title' => __( 'API Login ID', MS_TEXT_DOMAIN ),
				'type' => MS_Helper_Html::INPUT_TYPE_TEXT,
				'value' => $gateway->api_login_id,
				'class' => 'required',
			),

			'api_transaction_key' => array(
				'id' => 'api_transaction_key',
				'title' => __( 'API Transaction Key', MS_TEXT_DOMAIN ),
				'type' => MS_Helper_Html::INPUT_TYPE_TEXT,
				'value' => $gateway->api_transaction_key,
				'class' => 'required',
			),

			'pay_button_url' => array(
				'id' => 'pay_button_url',
				'title' => __( 'Payment button', MS_TEXT_DOMAIN ),
				'type' => MS_Helper_Html::INPUT_TYPE_TEXT,
				'value' => $gateway->pay_button_url,
			),

			'dialog' => array(
				'type' => MS_Helper_Html::INPUT_TYPE_HIDDEN,
				'name' => 'dialog',
				'value' => 'Gateway_' . $gateway->id . '_View_Dialog',
			),

			'gateway_id' => array(
				'type' => MS_Helper_Html::INPUT_TYPE_HIDDEN,
				'name' => 'gateway_id',
				'value' => $gateway->id,
			),

			'separator' => array(
				'type' => MS_Helper_Html::TYPE_HTML_SEPARATOR,
			),

			'close' => array(
				'id' => 'close',
				'type' => MS_Helper_Html::INPUT_TYPE_BUTTON,
				'value' => __( 'Close', MS_TEXT_DOMAIN ),
				'class' => 'close',
			),

			'save' => array(
				'id' => 'save',
				'type' => MS_Helper_Html::INPUT_TYPE_SUBMIT,
				'value' => __( 'Save Changes', MS_TEXT_DOMAIN ),
			),
		);

		return $fields;
	}

}