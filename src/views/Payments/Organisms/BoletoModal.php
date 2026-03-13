<?php
/**
 * src/views/Payments/Organisms/BoletoModal.php
 */
?>
<div id="boleto-modal">
    <?php
    $headerProps = [
        'class' => 'header header-modal',
        'onBack' => 'closeBoleto()',
        'logo' => '/public/assets/vendor/images/transpoicon.png'
    ];
    require BASE_PATH . '/src/views/Payments/Organisms/PaymentHeader.php';
    ?>
    <div class="pix-container">
        <div id="boleto-lead-section">
            <h3>Identificação</h3>
            <p style="color:var(--text-light); font-size:14px; margin-bottom: 30px;">Informe seus dados para
                identificação do pagamento.</p>

            <?php
            $props = ['label' => 'E-mail', 'id' => 'boleto-email', 'type' => 'email', 'value' => $viewData['user']['email'] ?? '', 'placeholder' => 'seu@email.com'];
            require BASE_PATH . '/src/views/Payments/Atoms/Input.php';

            $props = ['label' => 'Telefone / WhatsApp', 'id' => 'boleto-phone', 'value' => $viewData['user']['phone'] ?? '', 'placeholder' => '(00) 00000-0000'];
            require BASE_PATH . '/src/views/Payments/Atoms/Input.php';

            $props = ['label' => 'CPF', 'id' => 'boleto-cpf', 'value' => $viewData['cpf'], 'placeholder' => '000.000.000-00'];
            require BASE_PATH . '/src/views/Payments/Atoms/Input.php';

            $props = ['label' => 'GERAR BOLETO', 'type' => 'blue', 'onclick' => 'confirmBoletoLead()'];
            require BASE_PATH . '/src/views/Payments/Atoms/Button.php';
            ?>
        </div>

        <div id="boleto-payment-section" style="display:none;">
            <h3>Tudo pronto!</h3>
            <p style="color:var(--text-light); font-size:14px; margin-bottom: 30px;">Copie a linha digitável ou clique
                no botão para abrir seu boleto em PDF.</p>

            <div style="font-weight:bold; font-size:13px; margin-bottom:10px; color:#333;">Linha Digitável:</div>
            <div id="boleto-digitable-line"
                style="background:#f4f4f4; padding:15px; border-radius:8px; word-break:break-all; font-family:monospace; margin-bottom:15px; border:1px solid #ddd;">
            </div>

            <?php
            $props = ['label' => 'COPIAR CÓDIGO', 'type' => 'blue', 'onclick' => 'copyBoletoCode()', 'style' => 'margin-bottom: 12px;'];
            require BASE_PATH . '/src/views/Payments/Atoms/Button.php';
            ?>
            <a id="boleto-pdf-link" href="#" target="_blank"
                style="display:block; text-align:center; padding:12px; border:1px solid var(--mp-blue); color:var(--mp-blue); border-radius:8px; font-weight:600; text-decoration:none; margin-bottom:12px;">📄
                ABRIR BOLETO EM PDF</a>

            <?php
            $props = ['label' => 'JÁ FIZ O PAGAMENTO', 'type' => 'blue', 'onclick' => 'confirmPayment()', 'style' => 'background: transparent; color: var(--mp-blue); border: none;'];
            require BASE_PATH . '/src/views/Payments/Atoms/Button.php';
            ?>

            <p style="margin-top:20px; font-size:13px; color:var(--mp-blue); cursor:pointer;" onclick="closeBoleto()">
                Escolher outro meio de pagamento</p>
        </div>
    </div>
</div>