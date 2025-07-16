<div class="toolbar">
    <div class="ms-4">
        <label for="painel">Selecione o painel</label>
        <select class="form-select text-bg-dark panel-cables" name="painel" id="painel">
            <option value="E01" selected hidden>E01</option>
            @foreach ($paineis as $painel)
                <option value="{{ $painel }}">{{ $painel }}</option>
            @endforeach
        </select>
    </div>
    <div class="d-flex justify-content-between align-items-center toolbar-cable-buttons">
        <button class="btn toolbar-button single" disabled><i class="fa-solid fa-slash fa-rotate-270 fa-xl"></i></button>
        <button class="btn toolbar-button multi"><i class="fa-solid fa-lines-leaning fa-rotate-by rotate-icon fa-xl"></i></button>
    </div>
    <div class="toolbar-progress d-flex">
        <p class="progress-p">Progresso:</p>
        <p class="progress-count"></p>
    </div>
    <div class="toolbar-search">
        <input type="text" id="search" name="search" placeholder="Buscar" class="form-control search-input">
    </div>
    <div class="toolbar-buttons">
        <button class="btn toolbar-button"><i class="fa-solid fa-file-pdf fa-xl"></i></button>
        <button class="btn toolbar-button"><i class="fa-regular fa-message fa-xl"></i></button>
        <button class="btn toolbar-button"><i class="fa-solid fa-filter fa-xl"></i></button>
    </div>
    <div class="toolbar-finish-cable">
        <button id="alterarStatus" class="btn btn-warning m-2 d-none">
            Concluir cabos
        </button>
    </div>
</div>