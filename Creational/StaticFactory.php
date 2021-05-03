<?php
final class StaticFactory
{
    public static function factory(string $type): Formatter
    {
        if ($type == 'number') {
            return new FormatNumber();
        } elseif ($type == 'string') {
            return new FormatString();
        }

        throw new InvalidArgumentException('Unknown format given');
    }
}

interface Formatter
{
    public function format(string $input): string;
}

class FormatString implements Formatter
{
    public function format(string $input): string
    {
        return $input;
    }
}

class FormatNumber implements Formatter
{
    public function format(string $input): string
    {
        return number_format((int) $input);
    }
}

// 和簡單工廠很像 只是factory是static的