<div class="ms-1" x-data="{ estado: '' }"
     x-on:saved-creado.window="estado = 'sumado'"
     x-on:saved-eliminado.window="estado = 'restado'">
    <span :class="{
        'aumentado': estado === 'sumado',
        'disminuido': estado === 'restado'
    }">{{ $vecesGuardado }}</span>


<style>

    </style>


</div>
