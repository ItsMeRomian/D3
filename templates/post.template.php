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

        <div class="post">
            <div class="postTitle">
                <span class="title"><a href="post?id=<?= $this->values['id'] ?>"><?= $this->values['name'] ?></a></span>
            </div>
            <div class="postBody">
                <span>"<?= $this->values['body'] ?>"</span>
                <div class="postImage">
                    <img src="<?= $this->values['image'] ?>" style="max-height: 10rem;">
                </div>
            </div>
            <div class="postFooter">
                <span>Post door: <a href="profile?id=<?= $this->values['user']['id'] ?>"><?= $this->values['user']['username'] ?></a></span>
                <span>Gepost op: <?= $this->values['timePosted'] ?></span>
            </div>
        </div>
<?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
?>