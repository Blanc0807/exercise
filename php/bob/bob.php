<?php

class Bob {

    public  function respondTo($words) {
        $words = trim($words);
        if ($this->isSilence($words)) {
            return 'Fine. Be that way!';
        }

        $isYell = $this->isYell($words);
        $isQuestion = $this->isQuestion($words);

        if($isYell && $isQuestion) {
            return 'Calm down, I know what I\'m doing!';
        }

        if ($isYell) {
            return 'Whoa, chill out!';
        }

        if ($isQuestion) {
            return 'Sure.';
        }

        return 'Whatever.';
    }

    protected function isSilence($words) {
        return $words === '';
    }

    protected function isQuestion($words) {
        return substr($words, -1) === '?';
    }

    protected function isYell($words) {
        return preg_match('/[A-Z]/', $words) && $words === strtoupper($words);
    }

}
