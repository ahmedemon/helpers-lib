function numberToWords(number) {
    // Define arrays for words
    const ones = [
        "",
        "one",
        "two",
        "three",
        "four",
        "five",
        "six",
        "seven",
        "eight",
        "nine",
    ];
    const teens = [
        "",
        "eleven",
        "twelve",
        "thirteen",
        "fourteen",
        "fifteen",
        "sixteen",
        "seventeen",
        "eighteen",
        "nineteen",
    ];
    const tens = [
        "",
        "ten",
        "twenty",
        "thirty",
        "forty",
        "fifty",
        "sixty",
        "seventy",
        "eighty",
        "ninety",
    ];
    const thousands = ["", "thousand", "million", "billion", "trillion"];

    function convertChunk(chunk) {
        const words = [];

        if (chunk >= 100) {
            words.push(ones[Math.floor(chunk / 100)] + " hundred");
            chunk %= 100;
        }

        if (chunk >= 11 && chunk <= 19) {
            words.push(teens[chunk - 11]);
        } else {
            if (tens[Math.floor(chunk / 10)] !== "") {
                words.push(tens[Math.floor(chunk / 10)]);
            }
            if (ones[chunk % 10] !== "") {
                words.push(ones[chunk % 10]);
            }
        }

        return words.join(" ");
    }

    if (number === 0) {
        return "zero";
    }

    const numChunks = [];
    while (number > 0) {
        numChunks.push(number % 1000);
        number = Math.floor(number / 1000);
    }

    const wordsChunks = numChunks.map((chunk, index) => {
        if (chunk !== 0) {
            return convertChunk(chunk) + " " + thousands[index];
        }
        return "";
    });

    return wordsChunks
        .reverse()
        .filter((chunk) => chunk !== "")
        .join(" ");
}

    // EX:
    // const largeNumber = data.amount;
    // const wordsResult = numberToWords(largeNumber);
