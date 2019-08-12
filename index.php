<?php 
    require_once('core/init.php');
    require_once('view/header.php');
?>
    
<div class="container">
    <div class="side-form">
        <h1 class="side-form__title">POST YOUR TWEET</h1>
        <form action="" method="post">
            <div class="side-form__name">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" required>
            </div>

            <div class="side-form__email">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required>
            </div>
            
            <div class="side-form__tweet">
                <label for="tweet">Tweet</label>
                <textarea rows="4" cols="50" name="tweet" id="tweet" style="resize: none;" required></textarea>
            </div>
            
            <div class="side-form__post">
                <input type="submit" name="submit" class="btn mt-large" value="POST">
            </div>
        </form>
    </div>

    <?php 
        
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $tweet = $_POST['tweet'];
            
            $query = "SELECT MAX(id) as last_id FROM users LIMIT 1";
            $result = mysqli_query($link, $query);
            $data = mysqli_fetch_assoc($result);
            $user_id = $data['last_id'] + 1;
            
            insertToUsers($name, $email);
            insertToTweet($tweet, $user_id);

        }

        $users = read('users');
        $users_fetch = mysqli_fetch_all($users);
        $users_length = mysqli_num_rows($users);

        $posts = read('tweet');
    ?>

    <div class="feed">
        <div class="feed__cards">
            <?php 
                while($post = mysqli_fetch_assoc( $posts )):
            ?>
            <div class="feed__card">
                <div class="feed__card--title">
                    <h2>
                            <?php 
                                for($i = 0; $i < $users_length; $i++)
                                
                                {
                                    if($post['user_id'] == $users_fetch[$i][0])
                                    {
                                        echo $users_fetch[$i][1];
                                    } 
                                }
                            ?>
                    </h2>
                </div>
                <div class="feed__card--text">
                    <form action="update.php" method="get">
                        <textarea name="tweet" rows="4" cols="50" style="resize: none;"><?= $post['text']; ?></textarea>
                        <button class="feed_card--update" style="border: none; outline: none;" class="feed__card--update" name="user_id" value="<?= $post['user_id']?>">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    </form>
                </div>
                <div class="feed_card--delete">
                    <form action="delete.php" method="get" class="">
                        <button style="border: none; outline: none;" class="feed__card--delete" name="user_id" value="<?= $post['user_id']?>">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
            <?php
                endwhile;
            ?>
        </div>
    </div>
</div>





<?php
    require_once('view/footer.php') 
?>