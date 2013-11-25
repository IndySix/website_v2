<?PHP if(isset($titleMessage)): //Display title when set ?>
        <h1><?PHP echo $titleMessage ?></h1>
<?PHP endif; ?>

<?PHP if(isset($info)): //Display message when set ?>
        <p class="info"><?PHP echo $info ?></p>
<?PHP endif; ?>

<?PHP if(isset($success)): //Display message when set ?>
        <p class="success"><?PHP echo $success ?></p>
<?PHP endif; ?>

<?PHP if(isset($error)): //Display error when set ?>
        <p class="error"><?PHP echo $error ?></p>
<?PHP endif; ?>

<?PHP if(isset($warning)): //Display warning when set?>
        <p class="warning"><?PHP echo $warning ?></p>
<?PHP endif; ?>