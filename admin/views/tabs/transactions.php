<?php
/**
 * View: Transactions (Kubera)
 */
?>
<div id="section-transactions" class="table-container" style="display: none;">
    <div class="table-header">
        <h2>Registro de Transações</h2>
        <div class="search-box" style="position:relative;">
            <i class="fas fa-search"
                style="position:absolute; left:15px; top:50%; transform:translateY(-50%); color:var(--text-muted)"></i>
            <input type="text" placeholder="Filtrar transações..."
                style="width:300px; padding:10px 15px 10px 45px; background:rgba(255,255,255,0.05); border-radius:12px; margin:0;"
                onkeyup="filterTransactions(this.value)">
        </div>
    </div>

    <table id="transactionTable">
        <thead>
            <tr>
                <th>ID Transação</th>
                <th>Usuário</th>
                <th>Valor</th>
                <th>Gateway</th>
                <th>Data/Hora</th>
                <th>Meta Fields</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (array_reverse($transactions) as $txn): ?>
                <tr>
                    <td>
                        <code
                            style="background:rgba(255,255,255,0.05); padding:4px 8px; border-radius:6px; font-size:0.85rem; color:var(--red)">
                                    <?php echo htmlspecialchars($txn['id']); ?>
                                </code>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($txn['logged_user']); ?>
                    </td>
                    <td style="font-weight: 700;">R$
                        <?php echo number_format($txn['amount'], 2, ',', '.'); ?>
                    </td>
                    <td>
                        <span class="status-badge" style="background: rgba(255,255,255,0.05); color: #fff;">
                            <?php echo strtoupper(htmlspecialchars($txn['gateway'])); ?>
                        </span>
                    </td>
                    <td style="font-size: 0.85rem; color: var(--text-muted);">
                        <?php echo date('d/m/Y H:i', strtotime($txn['timestamp'])); ?>
                    </td>
                    <td>
                        <button class="btn-action" onclick='openMetaModal(<?php echo json_encode($txn['meta_fields']); ?>)'
                            title="Ver Meta Fields">
                            <i class="fas fa-project-diagram"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal para Meta Fields -->
<div id="metaModal" class="modal">
    <div class="modal-body" style="max-width: 800px;">
        <span class="close-modal" onclick="closeMetaModal()">&times;</span>
        <h2 style="margin-bottom: 30px; border-bottom: 1px solid var(--border); padding-bottom: 15px;">Meta Fields
            (Agnóstico)</h2>
        <div id="meta-content"
            style="background: #000; padding: 20px; border-radius: 15px; font-family: monospace; font-size: 0.9rem; color: #00ff88; overflow-x: auto; white-space: pre-wrap;">
        </div>
    </div>
</div>

<script>
    function openMetaModal(meta) {
        const content = document.getElementById('meta-content');
        content.innerText = JSON.stringify(meta, null, 4);
        document.getElementById('metaModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeMetaModal() {
        document.getElementById('metaModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function filterTransactions(val) {
        const filter = val.toLowerCase();
        const rows = document.querySelectorAll('#transactionTable tbody tr');
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    }
</script>