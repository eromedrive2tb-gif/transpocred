<?php
/**
 * Molecule/Auth: AuthInterceptor — intercepta cliques e submits de usuários não autenticados,
 * redirecionando-os para login.php. Único componente que consome $isLoggedIn.
 *
 * @param bool $isLoggedIn Injetado pelo HtmlHead.php a partir da sessão do usuário.
 */
?>
<script>
    const isUserLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
    if (!isUserLoggedIn) {
        document.addEventListener('click', function (e) {
            const target = e.target.closest('a:not(.remove-target), button:not(.remove-target)');
            if (target) {
                const href = target.getAttribute('href');
                const bypass = ['login.php', 'auth.php', 'register.php'];

                if (href && bypass.some(b => href.includes(b))) return;
                if (target.id === 'switch-mode') return;

                e.preventDefault();
                window.location.href = 'login.php';
            }
        });

        document.addEventListener('submit', function (e) {
            if (e.target.id === 'auth-form' || e.target.id === 'search-form-header') return;
            e.preventDefault();
            window.location.href = 'login.php';
        });
    }
</script>