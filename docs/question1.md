# 題目一：
- 您正在爬樓梯，樓梯具有 n 層階梯，您可以一次爬 1 層階梯，或是一次爬 2 層階梯，請問 n 層階梯有多少種方法可以登頂？


```
function fib(n) {
    if(n==1) return 1;
    if(n==2) return 2;

    return fib(n-1) + fib(n-2)
}

```
