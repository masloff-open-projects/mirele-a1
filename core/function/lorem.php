<?php

/**
 * @author: mpen
 * @see: https://stackoverflow.com/users/65387/mpen
 */

abstract class Lorem {
    public static function ipsum($nparagraphs) {
        $paragraphs = [];
        for($p = 0; $p < $nparagraphs; ++$p) {
            $nsentences = random_int(3, 8);
            $sentences = [];
            for($s = 0; $s < $nsentences; ++$s) {
                $frags = [];
                $commaChance = .33;
                while(true) {
                    $nwords = random_int(3, 15);
                    $words = self::random_values(self::$lorem, $nwords);
                    $frags[] = implode(' ', $words);
                    if(self::random_float() >= $commaChance) {
                        break;
                    }
                    $commaChance /= 2;
                }

                $sentences[] = ucfirst(implode(', ', $frags)) . '.';
            }
            $paragraphs[] = implode(' ', $sentences);
        }
        return implode("\n\n", $paragraphs);
    }

    private static function random_float() {
        return random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX;
    }

    private static function random_values($arr, $count) {
        $keys = array_rand($arr, $count);
        if($count == 1) {
            $keys = [$keys];
        }
        return array_intersect_key($arr, array_fill_keys($keys, null));
    }

    private static $lorem = ['lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit', 'praesent', 'interdum', 'dictum', 'mi', 'non', 'egestas', 'nulla', 'in', 'lacus', 'sed', 'sapien', 'placerat', 'malesuada', 'at', 'erat', 'etiam', 'id', 'velit', 'finibus', 'viverra', 'maecenas', 'mattis', 'volutpat', 'justo', 'vitae', 'vestibulum', 'metus', 'lobortis', 'mauris', 'luctus', 'leo', 'feugiat', 'nibh', 'tincidunt', 'a', 'integer', 'facilisis', 'lacinia', 'ligula', 'ac', 'suspendisse', 'eleifend', 'nunc', 'nec', 'pulvinar', 'quisque', 'ut', 'semper', 'auctor', 'tortor', 'mollis', 'est', 'tempor', 'scelerisque', 'venenatis', 'quis', 'ultrices', 'tellus', 'nisi', 'phasellus', 'aliquam', 'molestie', 'purus', 'convallis', 'cursus', 'ex', 'massa', 'fusce', 'felis', 'fringilla', 'faucibus', 'varius', 'ante', 'primis', 'orci', 'et', 'posuere', 'cubilia', 'curae', 'proin', 'ultricies', 'hendrerit', 'ornare', 'augue', 'pharetra', 'dapibus', 'nullam', 'sollicitudin', 'euismod', 'eget', 'pretium', 'vulputate', 'urna', 'arcu', 'porttitor', 'quam', 'condimentum', 'consequat', 'tempus', 'hac', 'habitasse', 'platea', 'dictumst', 'sagittis', 'gravida', 'eu', 'commodo', 'dui', 'lectus', 'vivamus', 'libero', 'vel', 'maximus', 'pellentesque', 'efficitur', 'class', 'aptent', 'taciti', 'sociosqu', 'ad', 'litora', 'torquent', 'per', 'conubia', 'nostra', 'inceptos', 'himenaeos', 'fermentum', 'turpis', 'donec', 'magna', 'porta', 'enim', 'curabitur', 'odio', 'rhoncus', 'blandit', 'potenti', 'sodales', 'accumsan', 'congue', 'neque', 'duis', 'bibendum', 'laoreet', 'elementum', 'suscipit', 'diam', 'vehicula', 'eros', 'nam', 'imperdiet', 'sem', 'ullamcorper', 'dignissim', 'risus', 'aliquet', 'habitant', 'morbi', 'tristique', 'senectus', 'netus', 'fames', 'nisl', 'iaculis', 'cras', 'aenean'];
}