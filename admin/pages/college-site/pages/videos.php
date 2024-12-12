<h3><i>Video</i></h3>

<form class="px-5" action="">
    <label for="inputGroupFile02">Insert Video: </label>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02">
    </div>
    <label for="card-title">Heading of Video: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="card-title" placeholder="Heading of Video" aria-label="Username" aria-describedby="addon-wrapping">
    </div>
    <label for="floatingselect">Free or Pro: </label>
    <select name="" id="floatingselect">
        <option value="" selected disabled>Select Video Free or Pro</option>
        <option value="free">Free</option>
        <option value="pro">Pro</option>
    </select>
    

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</form>


<style>
    select{
        width: 100%;
        padding: 5px;
        border: 1px solid gray;
    }
</style>
