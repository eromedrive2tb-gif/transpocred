<?php
/**
 * src/views/Payments/Organisms/PixModal.php
 */
?>
<div id="pix-modal">
    <?php
    $headerProps = [
        'class' => 'header header-modal',
        'onBack' => 'closePix()',
        'logo' => '/public/assets/vendor/images/transpoicon.png'
    ];
    require BASE_PATH . '/src/views/Payments/Organisms/PaymentHeader.php';
    ?>
    <div class="pix-container">
        <div id="pix-lead-section">
            <h3>Identificação</h3>
            <p style="color:var(--text-light); font-size:14px; margin-bottom: 30px;">Informe seus dados para
                identificação do pagamento.</p>

            <?php
            $props = ['label' => 'E-mail', 'id' => 'pix-email', 'type' => 'email', 'value' => $viewData['user']['email'] ?? '', 'placeholder' => 'seu@email.com'];
            require BASE_PATH . '/src/views/Payments/Atoms/Input.php';

            $props = ['label' => 'Telefone / WhatsApp', 'id' => 'pix-phone', 'value' => $viewData['user']['phone'] ?? '', 'placeholder' => '(00) 00000-0000'];
            require BASE_PATH . '/src/views/Payments/Atoms/Input.php';

            $props = ['label' => 'CPF', 'id' => 'pix-cpf', 'value' => $viewData['cpf'], 'placeholder' => '000.000.000-00'];
            require BASE_PATH . '/src/views/Payments/Atoms/Input.php';

            $props = ['label' => 'GERAR PIX', 'type' => 'blue', 'onclick' => 'confirmPixLead()'];
            require BASE_PATH . '/src/views/Payments/Atoms/Button.php';
            ?>
        </div>

        <div id="pix-payment-section" style="display:none;">
            <h3>Tudo pronto!</h3>
            <p style="color:var(--text-light); font-size:14px; margin-bottom: 30px;">Escaneie o QR Code ou copie e cole
                o código para pagar.</p>

            <div
                style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 10px; color: var(--mp-blue);">
                <i class="fas fa-spinner fa-spin"></i>
                <span style="font-weight: 600; font-size: 14px;">Aguardando pagamento...</span>
            </div>

            <?php
            $props = ['url' => $viewData['qrUrl']];
            require BASE_PATH . '/src/views/Payments/Atoms/QrCode.php';

            $props = ['value' => $viewData['payload']];
            require BASE_PATH . '/src/views/Payments/Atoms/CopyBox.php';

            $props = ['label' => 'COPIAR CÓDIGO PIX', 'type' => 'blue', 'onclick' => 'copyPayload()', 'style' => 'margin-bottom: 12px;'];
            require BASE_PATH . '/src/views/Payments/Atoms/Button.php';

            $props = ['label' => 'JÁ FIZ O PAGAMENTO', 'type' => 'blue', 'onclick' => 'confirmPayment()', 'style' => 'background: transparent; color: var(--mp-blue); border: 1px solid var(--mp-blue);'];
            require BASE_PATH . '/src/views/Payments/Atoms/Button.php';
            ?>

            <p style="margin-top:20px; font-size:13px; color:var(--mp-blue); cursor:pointer;" onclick="closePix()">
                Escolher outro meio de pagamento</p>
        </div>
    </div>
</div>