<?php include dirname(__DIR__, 4) . '/constant.php'; ?>

<h3><i>Add Blogs</i></h3>

<form class="px-5" action="<?php echo APP_PATH . "admin/pages/college-site/pages/actions/blogs.php"; ?>" method="POST" enctype="multipart/form-data">
    <label for="card-title">Heading: </label>
    <div class="input-group flex-nowrap">
        <input type="text" class="form-control" id="card-title" placeholder="Heading" name="name" required>
    </div>

    <label for="editor">Description: </label>
    <!-- Toolbar for the text editor -->
    <div class="editor-toolbar py-2">
        <button type="button" onclick="formatText('bold')" title="Bold"><b>B</b></button>
        <button type="button" onclick="formatText('italic')" title="Italic"><i>I</i></button>
        <button type="button" onclick="formatText('underline')" title="Underline"><u>U</u></button>
        <button type="button" onclick="formatText('insertUnorderedList')" title="Bullet List">• List</button>
        <button type="button" onclick="formatText('insertOrderedList')" title="Numbered List">1. List</button>
        <button type="button" onclick="addTable()" title="Table">Table</button>
        <button type="button" onclick="formatText('formatBlock', 'H1')" title="Heading 1">H1</button>
        <button type="button" onclick="formatText('formatBlock', 'H2')" title="Heading 2">H2</button>
        <button type="button" onclick="formatText('formatBlock', 'H3')" title="Heading 3">H3</button>
        <button type="button" onclick="formatText('formatBlock', 'H4')" title="Heading 4">H4</button>
        <button type="button" onclick="formatText('formatBlock', 'H5')" title="Heading 5">H5</button>
        <button type="button" onclick="formatText('formatBlock', 'H6')" title="Heading 6">H6</button>
    </div>

    <!-- Editable content area -->
    <div id="editor" contenteditable="true" class="form-control" 
        style="min-height: 200px; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
    </div>

    <!-- Hidden textarea to store editor content -->
    <textarea name="description" placeholder="Leave description here..." id="hiddenOverview" style="display: none;" required></textarea>

    <label for="inputGroupFile02">Featured Image: </label>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02" name="image" accept="image/*" required>
    </div>

    <div class="py-3">
        <button type="submit" class="btn btn-primary" name="save" onclick="syncEditorContent()">Save</button>
        <button type="reset" class="btn btn-danger" onclick="resetEditor()">Reset</button>
    </div>
</form>

