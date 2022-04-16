<div class="field">
    <label for="name">Name</label>
    <input 
        type="text"
        id="name"
        placeholder="Name of service"
        name="name"
        value="<?php echo $service->name?>"

    />
</div>
<div class="field">
    <label for="price">Price</label>
    <input 
        type="number"
        id="price"
        placeholder="Price of service"
        name="price"
        value="<?php echo $service->price?>"
    />
</div>