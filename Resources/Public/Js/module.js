function odl_selectAllDevices() {
	for (var d = 0, devices = document.getElementsByClassName('device'), dl = devices.length; d < dl; ++d) {
		devices[d].checked = true;
	}
}
function odl_selectNoneDevices() {
	for (var d = 0, devices = document.getElementsByClassName('device'), dl = devices.length; d < dl; ++d) {
		devices[d].checked = false;
	}
}