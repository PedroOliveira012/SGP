<form action="origem/{{ $cable_routing->id }}" method="POST">
    @csrf
    <button type="submit">origem</button>
    <input type="hidden" name="origin_value" value="{{ $cable_routing->origin_value }}">
</form>
<p>{{ $cable_routing->origin_value }}</p>

<form action="destino/{{ $cable_routing->id }}" method="POST">
    @csrf
    <button type="submit">destino</button>
    <input type="hidden" name="target_value" value="{{ $cable_routing->target_value }}">
</form>
<p>{{ $cable_routing->target_value }}</p>

<form action="finalizaCabo/{{ $cable_routing->id }}" method="POST">
    @csrf
    <button type="submit">Finaliza</button>
    <input type="hidden" name="origin_value" value="{{ $cable_routing->origin_value }}">
    <input type="hidden" name="target_value" value="{{ $cable_routing->target_value }}">
</form>
<p>{{ $cable_routing->status }}</p>
