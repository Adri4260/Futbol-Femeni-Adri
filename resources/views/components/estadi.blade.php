@props(['estadi'])

<tr>
    <td>{{ $estadi['nom'] ?? '-' }}</td>
    <td>{{ $estadi['ciutat'] ?? '-' }}</td>
    <td>{{ $estadi['capacitat'] ?? '-' }}</td>
    <td>{{ $estadi['equip_principal'] ?? '-' }}</td>
</tr>
