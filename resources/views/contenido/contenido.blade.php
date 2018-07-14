    @extends('principal')
    @section('contenido')

    @if(Auth::check())
            @if(Auth::user()->idrol == 1)
            <template v-if="menu==0">
                <dashboard></dashboard>
            </template>
        
                <template v-if="menu==1">
                    <cliente></cliente>
                </template>
        
                <template v-if="menu==2">
                    <platillo></platillo>
                </template>
        
                <template v-if="menu==3">
                    <categoriaplatillo></categoriaplatillo>
                </template>
        
                <template v-if="menu==4">
                    <mesa></mesa>
                </template>
        
                <template v-if="menu==5">
                    <empleado></empleado>
                </template>
        
                <template v-if="menu==6">
                    <rol></rol>
                </template>
        
                <template v-if="menu==7">
                    <user></user>
                </template>
        
                <template v-if="menu==8">
                    <h1>Contenido del menú 8</h1>
                </template>
        
                <template v-if="menu==9">
                    <h1>Contenido del menú 9</h1>
                </template>
        
                <template v-if="menu==10">
                    <venta></venta>
                </template>
        
                <template v-if="menu==14">
                    <consultaingreso></consultaingreso>
                </template>
                <template v-if="menu==15">
                    <consultaventa></consultaventa>
                </template>
                <template v-if="menu==20">
                    <categoria></categoria>
                </template>
                <template v-if="menu==21">
                    <articulo><articulo>
                </template>
                <template v-if="menu==22">
                    <proveedor></proveedor>
                </template>
                <template v-if="menu==23">
                    <ingreso></ingreso>
                </template>
                <template v-if="menu==24">
                    <pedido></pedido>
                </template>
            @elseif (Auth::user()->idrol == 2)
                 <template v-if="menu==0">
                <dashboard></dashboard>
                </template>
                <template v-if="menu==2">
                    <platillo></platillo>
                </template>
        
                <template v-if="menu==3">
                    <categoriaplatillo></categoriaplatillo>
                </template>
        
                <template v-if="menu==4">
                    <mesa></mesa>
                </template>
            @elseif (Auth::user()->idrol == 3)
                <template v-if="menu==0">
                    <dashboard></dashboard>
                </template>
                <template v-if="menu==1">
                    <cliente></cliente>
                </template>
        
                <template v-if="menu==2">
                    <platillo></platillo>
                </template>
        
                <template v-if="menu==3">
                    <categoriaplatillo></categoriaplatillo>
                </template>
        
                <template v-if="menu==4">
                    <mesa></mesa>
                </template>
            @else

            @endif
        @endif
    @endsection