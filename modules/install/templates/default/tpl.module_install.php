<form action="index.php?module=<?php echo $this->name(); ?>&action=install" method="POST">
    <input class="" type="text" name="module" value="<?php echo $this->translate('Module name'); ?>" />
    <input id="install" type="submit" name="install" value="<?php echo $this->translate('Install'); ?>" />    
</form>