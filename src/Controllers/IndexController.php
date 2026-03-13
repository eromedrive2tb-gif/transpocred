<?php

/**
 * IndexController
 *
 * Responsabilidade única: preparar os dados de sessão/autenticação
 * necessários para a view da página inicial.
 *
 * Esta classe não conhece HTML, HTTP ou qualquer protocolo de entrega.
 * Não realiza echo diretamente.
 */
class IndexController
{
    /**
     * Processa o estado de autenticação e retorna os dados de view.
     *
     * @return array{isLoggedIn: bool, username: string}
     */
    public static function handle(): array
    {
        $isLoggedIn = isLoggedIn();
        $username = $isLoggedIn ? htmlspecialchars($_SESSION['user'] ?? '') : '';

        return [
            'isLoggedIn' => $isLoggedIn,
            'username' => $username,
        ];
    }
}
