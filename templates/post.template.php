<?php
//Post template: Deze class doet niks anders dan een posts laten zien, er zit verder geen data ophalen ofzo achter.
class PostTemplate
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
            <h2>Post #<?= $this->values['id'] ?></h2>
            <table>
                <tr>
                    <td><?= $this->values['id'] ?></td>
                    <td><?= $this->values['userId'] ?></td>
                    <td><?= $this->values['name'] ?></td>
                    <td><?= $this->values['body'] ?></td>
                    <td><?= $this->values['image'] ?></td>
                    <td><?= $this->values['timePosted'] ?></td>
                </tr>
            </table>
        </div>
<?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
?>