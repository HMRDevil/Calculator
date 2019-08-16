<?php
declare(strict_types=1);

use Calc\Calculator;
use Phplrt\Source\File;
use Symfony\Component\Console\Output\StreamOutput;
use Phplrt\Parser\Exception\ParserRuntimeException;

require __DIR__ . '/../vendor/autoload.php';

$output = new StreamOutput(STDOUT);

$output->writeln('<info> Hello Stranger! </info>');
$output->writeln('<comment> // Write an expression (like "2+2") to get an answer</comment>');
$output->writeln('<comment> // Write "exit" to exit (Vnezapno!)</comment>');

$calc = new Calculator();

while (! $expression = '') {
    while (! $expression) {
        $output->write('<question> > </question> ');
        $expression = \trim(\preg_replace('/\s+/', ' ', fgets(STDIN)));
    }

    if (\strtolower($expression) === 'exit') {
        $output->writeln('<question>   </question> <info>Bye!</info>');
        exit(0);
    }

    try {
        $output->writeln(vsprintf('<question>   </question> <info>%s</info> <comment>(%s)</comment>', [
            $result = $calc->calc(File::fromSources($expression)),
            \is_int($result) ? 'int' : 'float'
        ]));
    } catch (ParserRuntimeException $error) {
        foreach (error($error, $expression) as $line) {
            $output->writeln(sprintf('<error>     %s     </error>', $line));
        }
    }
}


function error(ParserRuntimeException $error, string $expr): iterable
{
    $token = $error->getToken();
    $offset = $token->getOffset();

    $message = \sprintf('Syntax error in %s at offset %d', $token, $offset);
    $length = \strlen($message);
    $delimiter = \str_repeat(' ', $length);

    yield $delimiter;
    yield $message;
    yield $delimiter;
    yield \str_pad($expr, $length);
    yield \str_pad(
        \str_repeat(' ', $offset) .
        \str_repeat('^', \mb_strlen($token->getValue())),
        $length
    );
}
