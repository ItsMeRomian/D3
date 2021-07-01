<?php
class ErrorHandler
{

    public int $errorCode;
    public string $errorMessage;

    function __construct($errorCode, $errorMessage)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
    }

    function killing(): void
    {
        die("
        <span class='error'>
            <span class='title'>Something went wrong!</span><br>
            $this->errorCode: $this->errorMessage
        </span>");
    }
    function soft(): void
    {
        echo "
        <span class='error'>
            <span class='title'>Something went wrong!</span><br>
            $this->errorCode: $this->errorMessage
        </span>";
    }
}
