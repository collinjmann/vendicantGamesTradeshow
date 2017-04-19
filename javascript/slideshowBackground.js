function slideshowBackground(files, id, id2)
{
	var source = document.getElementById(id);
	var buttons = document.createElement("div");
	var index = 0;
	this.timer;

	this.slide = function()
	{
		if (index > files.length - 1)
		{
			index = 0;
		}
		for (var i = 0; i < files.length; i++)
		{
			buttons.getElementsByTagName("div")[i].className = "";
		}
		buttons.getElementsByTagName("div")[index].className = "active";
		source.style.backgroundImage = "url(" + files[index] + ")";
		index++;
	}

	if (id2 === undefined)
    {
        source.appendChild(buttons);
    }
    else
    {
        document.getElementById(id2).appendChild(buttons);        
    }

	for (var i = 0; i < files.length; i++)
	{
		var hold = document.createElement("div");
		hold.id = String(i);
		hold.onclick = function()
		{
			index = Number(this.id);
		}
		hold.addEventListener("click", this.slide);
		buttons.appendChild(hold);
	}

	this.slide();
	this.timer = setInterval(this.slide, 5000);
}