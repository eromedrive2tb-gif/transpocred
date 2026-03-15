<?php
/**
 * Molecule: Formulário de busca do header.
 * Atomic Design — Refactor Clean Architecture
 */
?>
			<div class="search-form-header">
				<div class="container row">
					<div class="col-10 mobile_order_2">
						<form id="search-form-header" action="https://www.transpocred.coop.br/busca" method="get">
							<input id="search-input-header"
								data-autocomplete-url="https://www.transpocred.coop.br/wp-admin/admin-ajax.php?action=get_keywords"
								name="termo" type="text" placeholder="O que você precisa?">
							<button id="search-btn-header" type="submit"></button>
						</form>
					</div>
					<div class="col-2 search-form-header-close-btn mobile_order_1">
						<p>
							Fechar
						</p>
					</div>
				</div>
			</div>
