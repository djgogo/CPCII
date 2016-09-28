<?php

if (class_exists('PHP_CodeSniffer_Standards_AbstractScopeSniff', true) === false) {
    throw new PHP_CodeSniffer_Exception('Class PHP_CodeSniffer_Standards_AbstractScopeSniff not found');
}

class CodeReview_Sniffs_PHP_NonPublicConstructorSniff extends PHP_CodeSniffer_Standards_AbstractScopeSniff
{
    public function __construct()
    {
        parent::__construct(array(T_CLASS, T_INTERFACE, T_TRAIT), array(T_FUNCTION));
    }

    /**
     * Processes a token that is found within the scope that this test is
     * listening to.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where this token was found.
     * @param int $stackPtr The position in the stack where this token was found.
     * @param int $currScope The position in the tokens array that opened the scope that this test is listening for.
     */
    protected function processTokenWithinScope(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $currScope)
    {
        $tokens = $phpcsFile->getTokens();

        $methodName = $phpcsFile->getDeclarationName($stackPtr);
        if ($methodName === null || $methodName !== '__construct') {
            // only constructor
            return;
        }

        if ($phpcsFile->hasCondition($stackPtr, T_FUNCTION) === true) {
            // Ignore nested functions.
            return;
        }

        $modifier = null;
        $type = null;

        for ($i = ($stackPtr - 1); $i > 0; $i--) {
            if ($tokens[$i]['line'] < $tokens[$stackPtr]['line']) {
                break;
            } else if (isset(PHP_CodeSniffer_Tokens::$scopeModifiers[$tokens[$i]['code']]) === true) {
                $type = $tokens[$i]['type'];
                $modifier = $i;
                break;
            }
        }

        if ($modifier === null) {
            $error = 'Visibility must be declared on method "%s"';
            $data  = array($methodName);
            $phpcsFile->addError($error, $stackPtr, 'Missing', $data);
        }

        if ($type === 'T_PRIVATE' || $type === 'T_PROTECTED') {
            $error = 'Non-public constructor found';
            $data  = array($methodName);
            $phpcsFile->addError($error, $stackPtr, 'NotAllowed', $data);
        }
    }
}
