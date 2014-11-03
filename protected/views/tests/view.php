<h2><?=$test->name?></h2>
<h3>Вопрос <?=$question_num?> из <?=$test->getQuestionsCount()?></h3>

<div>
    <?=$question->question?>
</div> <br />
<?php
    $answers = (array) $question->answers;
    $i = 1;
    
    foreach($answers as $answer_id => $answer) {
        $answer = (object) $answer;
        ?>
            <?=$i?>. 
            <a href = "<?=$this->createUrl("tests/view", array(
                "id" => $test->_id,
                "question_id" => $question_id,
                "answer" => $answer_id
            ))?>">
                <?=$answer->answer?>
            </a> <br />
        <?php
            
        $i++;
    }
?>