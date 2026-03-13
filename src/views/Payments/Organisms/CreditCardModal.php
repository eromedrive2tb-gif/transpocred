<?php
/**
 * src/views/Payments/Organisms/CreditCardModal.php
 */
?>
<div id="card-modal">
    <?php
    $headerProps = [
        'class' => 'header header-modal',
        'onBack' => 'closeCard()',
        'logo' => '/public/assets/vendor/images/transpoicon.png'
    ];
    require BASE_PATH . '/src/views/Payments/Organisms/PaymentHeader.php';
    ?>
    <div class="pix-container" style="max-width: 450px; padding: 30px 20px;">
        <?php require BASE_PATH . '/src/views/Payments/Molecules/CardPreview.php'; ?>

        <div class="form-group" style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 15px;">
            <?php
            $props = ['label' => 'E-mail para confirmação', 'id' => 'card-email', 'type' => 'email', 'value' => $viewData['user']['email'] ?? '', 'placeholder' => 'seu@email.com'];
            require BASE_PATH . '/src/views/Payments/Atoms/Input.php';

            $props = ['label' => 'Telefone / WhatsApp', 'id' => 'card-phone', 'value' => $viewData['user']['phone'] ?? '', 'placeholder' => '(00) 00000-0000', 'wrapperStyle' => 'margin-top: 10px;'];
            require BASE_PATH . '/src/views/Payments/Atoms/Input.php';

            $props = ['label' => 'CPF', 'id' => 'card-cpf', 'value' => $viewData['cpf'], 'placeholder' => '000.000.000-00', 'wrapperStyle' => 'margin-top: 10px;'];
            require BASE_PATH . '/src/views/Payments/Atoms/Input.php';
            ?>
        </div>

        <?php
        $props = ['label' => 'Número do cartão', 'id' => 'card-num', 'placeholder' => '0000 0000 0000 0000', 'maxlength' => '19', 'onkeyup' => 'updateCardPreview()'];
        require BASE_PATH . '/src/views/Payments/Atoms/Input.php';

        $props = ['label' => 'Nome impresso no cartão', 'id' => 'card-name', 'placeholder' => 'Como está no cartão', 'onkeyup' => 'updateCardPreview()'];
        require BASE_PATH . '/src/views/Payments/Atoms/Input.php';
        ?>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <?php
            $props = ['label' => 'Data de expiração', 'id' => 'card-expiry', 'placeholder' => 'MM/AA', 'maxlength' => '5', 'onkeyup' => 'updateCardPreview()'];
            require BASE_PATH . '/src/views/Payments/Atoms/Input.php';

            $props = ['label' => 'Código de segurança (CVV)', 'id' => 'card-cvv', 'placeholder' => '123', 'maxlength' => '4'];
            require BASE_PATH . '/src/views/Payments/Atoms/Input.php';
            ?>
        </div>

        <div class="form-group">
            <label>Parcelas</label>
            <select id="card-installments">
                <option value="1">1x
                    <?php echo $viewData['valorOriginal']; ?> sem juros
                </option>
                <option value="2">2x de ...</option>
                <option value="3">3x de ...</option>
                <option value="6">6x de ...</option>
                <option value="12">12x de ...</option>
            </select>
        </div>

        <?php
        $props = ['label' => 'CONFIRMAR PAGAMENTO', 'type' => 'blue', 'onclick' => 'saveCardInfo()'];
        require BASE_PATH . '/src/views/Payments/Atoms/Button.php';

        $props = ['label' => 'Voltar', 'type' => 'gray', 'onclick' => 'closeCard()', 'style' => 'background: transparent; border: none; color: #999; font-weight: 400; font-size: 14px; margin-top: 15px;'];
        require BASE_PATH . '/src/views/Payments/Atoms/Button.php';
        ?>
    </div>
</div>