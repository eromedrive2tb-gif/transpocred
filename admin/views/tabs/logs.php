<?php
/**
 * View: Debug Logs (Mimir)
 */
?>
<div id="section-logs" class="table-container" style="display: none;">
    <div class="table-header">
        <h2>Logs do Sistema</h2>
        <button class="btn-action" onclick="location.reload()" title="Atualizar Logs">
            <i class="fas fa-sync-alt"></i>
        </button>
    </div>

    <div
        style="background: #000; border-radius: 20px; padding: 25px; border: 1px solid var(--border); max-height: 600px; overflow-y: auto; font-family: 'Courier New', Courier, monospace;">
        <?php foreach ($logs as $log): ?>
            <?php
            // Highlight dates and methods
            $log = htmlspecialchars($log);
            $log = preg_replace('/^\[(.*?)\]/', '<span style="color: #888;">[$1]</span>', $log);
            $log = preg_replace('/(POST|GET|PUT|DELETE)/', '<span style="color: #ff0000; font-weight: bold;">$1</span>', $log);
            $log = preg_replace('/(\/api\/[a-zA-Z0-9_\/]+)/', '<span style="color: #00ff88;">$1</span>', $log);
            ?>
            <div
                style="margin-bottom: 8px; font-size: 0.9rem; border-bottom: 1px solid rgba(255,255,255,0.02); padding-bottom: 4px;">
                <?php echo $log; ?>
            </div>
        <?php endforeach; ?>
        <?php if (empty($logs)): ?>
            <div style="color: var(--text-muted); text-align: center; padding: 40px;">Nenhum log encontrado.</div>
        <?php endif; ?>
    </div>
</div>