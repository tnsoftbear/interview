# Unit testing task

Below is fictional code sample that performs some decision-making logic. It calculates some amount according to inputs on the base of conditional logic. It produces Result object:

* either with calculated amount and success status code, in case of successfully completed calculation,
* or error status code, in case of failed calculation.

There are 2 artificial services (`UserAmountService`, `AuctionAmountService`) that should read data from external out-of-process resource in real application. Imagine they do that in this task.

Your task is write unit test for `Calculator` logic. You can refactor it anyway you would like to do, so it will be possible to cover it with unit test. Implemented unit test should be based on PHPUnit framework and pass testing data-sets organized with help of @dataProvider. It should cover all possible edge-cases.

Before starting please tell, what kind of refactorings should you do on `Calculator` class, so it could be unit tested in the desired way?
