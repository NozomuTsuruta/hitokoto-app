<?php
session_start();
require('dbconnect.php');

if(empty($_REQUEST['id'])){
    header('Location: insert.php');
    exit();
}

$posts = $db->prepare('SELECT m.name,m.picture,p.* FROM members m,posts p WHERE m.id=p.member_id AND p.id=? ORDER BY p.created DESC');
$posts->execute(array($_REQUEST['id']));
?>
<?php require('header.php') ?>
<div id="wrap">
    <div id="head">
        <h1>ひとこと広場</h1>
    </div>
    <div id="content">
        <p>&laquo;<a href="insert.php">一覧に戻る</a></p>
        <?php
        if($post=$posts->fetch()):
        ?>
        <div class="mag">
            <img src="member_picture/<?php echo htmlspecialchars($post['picture'],ENT_QUOTES);?>"
                width="48" height="48"
                alt="<?php echo htmlspecialchars($post['name'],ENT_QUOTES); ?>" />
            <p><?php echo htmlspecialchars($post['message'],ENT_QUOTES); ?><span
                    class="name">
                    (<?php echo htmlspecialchars($post['name'],ENT_QUOTES); ?>)
                </span>
            </p>
            <p class="day"><?php echo htmlspecialchars($post['created'],ENT_QUOTES); ?>
            </p>
        <?php else:?>
            <p>その投稿は削除されたか、URLを間違えています</p>
        <?php endif; ?>
    </div>
</div>

<?php require('footer.php');?>