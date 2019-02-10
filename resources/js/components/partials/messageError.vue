<template>
	<div v-if="message" class="text-danger">
     {{ message[0] }}
  </div>
</template>

<script>
	// wrench
	// check-double
	export default {
		name: 'message-error',
		props: ['message']
	}
</script>

