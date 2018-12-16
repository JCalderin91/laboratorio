<template>
	<div class="col-md-4">
		<div :class="'widget rounded '+ type">
			<div class="cover"></div>
			<i :class="'fa fa-'+icon+' text-white'"></i>
			<span class="h2 text-white">08</span>
		</div>
	</div>
</template>

<script>
	// wrench
	// check-double
	export default {
		name: 'widget',
		props: ['type', 'icon']
	}
</script>


<style scoped>
	.widget.pendientes{
		background-color: var(--danger);
	}
	.widget.revisados{
		background-color: var(--primary);
	}
	.widget.entregados{
		background-color: var(--success);
	}
	.widget{
		display: flex;
		justify-content: flex-end;
		align-items: center;
		position: relative;
		overflow: hidden;
	}
	.widget .fa{
		position: absolute;
		top: 50%;
		left: 10px;
		transform: translateY(-50%);
		font-size: 5rem;
		opacity: .5;
	}
	.widget .fa:hover{

	}
	.widget span{
		padding: 30px;
		background-color: rgba(0,0,0,.3);
		margin-bottom: 0;
	}

	.cover{
		content:"";
		position: absolute;
		top:0;
		left:-21%;
		width: 0%;
		height: 100%;
		background-color:rgba(0,0,0,.2);
		transform: skewX(-45deg);
		transition: all .5s ease;
	}
	.widget:hover > .cover{
		width:141%;
	}

</style>