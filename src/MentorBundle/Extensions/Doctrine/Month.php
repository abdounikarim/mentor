<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 18/06/2017
 * Time: 10:12
 */

namespace MentorBundle\Extensions\Doctrine;


use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * Class Month
 * @package MentorBundle\Extensions\Doctrine
 *
 * DateFunction ::= "MONTH" "(" ArithmeticPrimary ")"
 */
class Month extends FunctionNode
{
    public $dateExpression;

    /**
     * @param SqlWalker $sqlWalker
     *
     * @return string
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return 'MONTH(' . $this->dateExpression->dispatch($sqlWalker) . ')';
    }

    /**
     * @param Parser $parser
     *
     * @return void
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->dateExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
