<!-- app/Views/components/modal.php -->
<div class="modal-backdrop" id="<?= $id ?? 'app-modal' ?>" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-header">
            <h3 class="modal-title"><?= $title ?? 'Garba26' ?></h3>
            <button class="modal-close" onclick="this.closest('.modal-backdrop').style.display='none'">&times;</button>
        </div>
        <div class="modal-body">
            <?= $content ?? '' ?>
        </div>
    </div>
</div>
