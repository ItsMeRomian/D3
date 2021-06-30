<?php
//USer template: Dit laat een simpele stackable user card zien
class UserTemplate
{
    private $values;
    function __construct($values)
    {
        $this->values = $values;
    }
    function __toString()
    {
        ob_start();
?>
        <div style="border: solid;">
            <img src="<?= $this->values['profilepicture'] ?>" class="profilepicture">
            <h1><a href="http://localhost/D3/profile?id=<?= $this->values['id'] ?>"><?= $this->values['username'] ?></a></h1>
        </div>
<?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
?>