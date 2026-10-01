<!-- app/Views/components/button.php -->
<button type="<?= $type ?? 'button' ?>" class="btn <?= $class ?? 'btn-primary' ?>" <?= $attrs ?? '' ?>>
    <?= $slot ?? 'Click' ?>
</button>
