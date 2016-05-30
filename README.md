# `array_change_keys` results

This repo is a simple benchmark around the `array_change_keys()` PHP RFC that
can be found at https://wiki.php.net/rfc/array_change_keys

## TL;DR

`array_change_keys` is 35% slower than simply using a `foreach` (and doesn't support iterators :-P ).

## Run this shit

To run the benchmark, simply use `./run.sh`.

## Actual numbers

Here's an example report of the output as it currently stands (currently tested against
https://github.com/php/php-src/pull/1925/commits/eae1ae3dcce139952ac488973fcf459299d87964).

#### Environment:

```
 ~/Documents/Projects/php-src/sapi/cli/php ./vendor/bin/phpbench run BenchArrayChangeKeys.php --report=env                                                                       22:15  ocramius@Marcos-MacBook-Pro
PhpBench 0.11-dev (@git_sha@). Running benchmarks.
Using configuration file: /Users/ocramius/Desktop/bench/phpbench.json

\Bench\BenchArrayChangeKeys

    benchSimpleLoopArrayKeyChangingI99 P0 	[μ Mo]/r: 31.467 29.958 (μs) 	[μSD μRSD]/r: 2.799μs 8.89%
    benchArrayCombineArrayKeyChangingI99 P0 	[μ Mo]/r: 56.282 54.042 (μs) 	[μSD μRSD]/r: 4.119μs 7.32%
    benchArrayChangeKeys          I99 P0 	[μ Mo]/r: 49.467 47.483 (μs) 	[μSD μRSD]/r: 3.544μs 7.16%

3 subjects, 300 iterations, 30 revs, 0 rejects
(best [mean mode] worst) = 28.700 [45.739 43.828] 44.000 (μs)
⅀T: 13,721.600μs μSD/r 3.487μs μRSD/r: 7.792%
Suite #133a0122121056244cd25bc3728443f920dbc5b8 2016-05-30 20:15:32
+----------+---------+--------------------------------------------------------------------------------------------------+
| provider | key     | value                                                                                            |
+----------+---------+--------------------------------------------------------------------------------------------------+
| uname    | os      | Darwin                                                                                           |
| uname    | host    | Marcos-MacBook-Pro.local                                                                         |
| uname    | release | 15.5.0                                                                                           |
| uname    | version | Darwin Kernel Version 15.5.0: Tue Apr 19 18:36:36 PDT 2016; root:xnu-3248.50.21~8/RELEASE_X86_64 |
| uname    | machine | x86_64                                                                                           |
| php      | version | 7.1.0-dev                                                                                        |
| vcs      | system  | git                                                                                              |
| vcs      | branch  | master                                                                                           |
| vcs      | version | 4ff9a1904315949b957eb74c46316463c7f9aeee                                                         |
| baseline | nothing | 0.020980834960938                                                                                |
| baseline | md5     | 0.32401084899902                                                                                 |
| baseline | file_rw | 1.640796661377                                                                                   |
+----------+---------+--------------------------------------------------------------------------------------------------+
```

#### Actual results:

```
~/Documents/Projects/php-src/sapi/cli/php ./vendor/bin/phpbench run BenchArrayChangeKeys.php --report=aggregate                                                                 22:15  ocramius@Marcos-MacBook-Pro
PhpBench 0.11-dev (@git_sha@). Running benchmarks.
Using configuration file: /Users/ocramius/Desktop/bench/phpbench.json

\Bench\BenchArrayChangeKeys

    benchSimpleLoopArrayKeyChangingI99 P0 	[μ Mo]/r: 31.645 29.999 (μs) 	[μSD μRSD]/r: 3.125μs 9.87%
    benchArrayCombineArrayKeyChangingI99 P0 	[μ Mo]/r: 56.252 53.922 (μs) 	[μSD μRSD]/r: 4.155μs 7.39%
    benchArrayChangeKeys          I99 P0 	[μ Mo]/r: 49.162 47.321 (μs) 	[μSD μRSD]/r: 3.772μs 7.67%

3 subjects, 300 iterations, 30 revs, 0 rejects
(best [mean mode] worst) = 28.700 [45.686 43.747] 44.500 (μs)
⅀T: 13,705.900μs μSD/r 3.684μs μRSD/r: 8.311%
suite: 133a012802990c6b9a6c66409404f7296da50b90, date: 2016-05-30, stime: 20:16:45
+----------------------+-----------------------------------+--------+--------+------+-----+----------+----------+----------+----------+----------+---------+--------+---------+
| benchmark            | subject                           | groups | params | revs | its | mem      | best     | mean     | mode     | worst    | stdev   | rstdev | diff    |
+----------------------+-----------------------------------+--------+--------+------+-----+----------+----------+----------+----------+----------+---------+--------+---------+
| BenchArrayChangeKeys | benchSimpleLoopArrayKeyChanging   |        | []     | 10   | 100 | 751,000b | 28.700μs | 31.645μs | 29.999μs | 44.500μs | 3.125μs | 9.87%  | 0.00%   |
| BenchArrayChangeKeys | benchArrayCombineArrayKeyChanging |        | []     | 10   | 100 | 787,928b | 52.100μs | 56.252μs | 53.922μs | 71.500μs | 4.155μs | 7.39%  | +43.74% |
| BenchArrayChangeKeys | benchArrayChangeKeys              |        | []     | 10   | 100 | 751,344b | 46.000μs | 49.162μs | 47.321μs | 68.500μs | 3.772μs | 7.67%  | +35.63% |
+----------------------+-----------------------------------+--------+--------+------+-----+----------+----------+----------+----------+----------+---------+--------+---------+
```

## Licence

This is MIT. I CBA to add the licence headers: send a PR if you need 'em'.

## Credits

Initial benchmark at https://gist.github.com/colinodell/872c1f0c92351af687347c0c8be4f253
