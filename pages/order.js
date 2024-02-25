// disabling minus btn
document.querySelector(".minus-btn").setAttribute("disabled", "disabled");

var valueCount

// for increment
document.querySelector(".plus-btn").addEventListener("click", function ()
{
    valueCount = document.getElementById("quantity").value;

    valueCount++;

    document.getElementById("quantity").value = valueCount;

    if (valueCount > 1)
    {
        document.querySelector(".minus-btn").removeAttribute("disabled");
        document.querySelector(".minus-btn").classList.remove("disabled");
    }
})

// for decrement

document.querySelector(".minus-btn").addEventListener("click", function ()
{
    valueCount = document.getElementById("quantity").value;

    valueCount--;

    document.getElementById("quantity").value = valueCount;

    if (valueCount == 1)
    {
        document.querySelector(".minus-btn").setAttribute("disabled", "disabled");
    }
})
