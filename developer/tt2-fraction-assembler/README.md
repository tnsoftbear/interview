# Testing task "Fraction assembler"

## Task

Find class draft with unit tests in [tt2-fraction-assembler.php](tt2-fraction-assembler.php). Run `php tt2-fraction-assembler.php` to execute testing data sets.

Complete `FractionAssembler::assemble()` logic.  
FYI: Sample implementation of FractionAssembler class is simple - it takes 100 lines, it uses 5 native php functions, no complicated logic.

`FractionAssembler` class logic must assemble rendering result from fractions and their additional extensions.  
For instance time left, file size output. Possible result examples:

* 5 days, 10 hours 30 minutes 45 seconds
* 5 10:30:45
* 5d 10h 30m 45s
* 5Gb 10Mb 30Kb 45B

It must be configurable to trim zero values from left and right sides. It should be able to perform final trimming of separation characters.

You could follow the [link](https://tehplayground.com/kipdAIuVyyVEujWq) to find the same task for coding and executing its tests.

## Clarification

We often need to display some numeric value separated to parts. It may be second count, that we want to split to days, hours, minutes, seconds. It may be file size, that we want to split to gigabytes, megabytes, kilobytes, bytes.
You can think about input of 516645 seconds and expected outputs like "5 days, 23 hours 30 minutes 45 seconds", or "5d 23h 30m 45s", or "5d 23:30:45".
You can think about input of 20981760 bytes and expected output like "10MB 20KB" - byte part is trimmed here, because it is zero.

You can see, that apart from numeric value, that we need to divide into fractions, we want to provide clarifications for them, they may be represented as array of extensions `[' days, ', ' hours ', ' minutes ', ' seconds']`.

Since we want to make logic universal, we want it to be possible to define several options.
I.e. should our function trim zero values from the left or from the right sides, or it shouldn't. Implement 2 boolean options for this.
Since we allow to trim zero elements from both sides, we may need to remove redundant separation characters, like commas, colons, etc. Implement an option for this too.

See, this task is not only about correct implementation, but you also need to think how to make code simple and neat. Think about class structure, methods and variables naming, code style, phpDoc annotations, proper comments.  
Don't worry about error handling much, we suppose, that function consumer provides correct inputs. But you may assert and check vital invariant.
