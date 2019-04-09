web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545"));
abi = JSON.parse('[{"constant":false,"inputs":[{"name":"candidate","type":"bytes32"}],"name":"totalVotesFor","outputs":[{"name":"","type":"uint8"}],"payable":false,"type":"function"},{"constant":false,"inputs":[{"name":"candidate","type":"bytes32"}],"name":"validCandidate","outputs":[{"name":"","type":"bool"}],"payable":false,"type":"function"},{"constant":true,"inputs":[{"name":"","type":"bytes32"}],"name":"votesReceived","outputs":[{"name":"","type":"uint8"}],"payable":false,"type":"function"},{"constant":true,"inputs":[{"name":"x","type":"bytes32"}],"name":"bytes32ToString","outputs":[{"name":"","type":"string"}],"payable":false,"type":"function"},{"constant":true,"inputs":[{"name":"","type":"uint256"}],"name":"candidateList","outputs":[{"name":"","type":"bytes32"}],"payable":false,"type":"function"},{"constant":false,"inputs":[{"name":"candidate","type":"bytes32"}],"name":"voteForCandidate","outputs":[],"payable":false,"type":"function"},{"constant":true,"inputs":[],"name":"contractOwner","outputs":[{"name":"","type":"address"}],"payable":false,"type":"function"},{"inputs":[{"name":"candidateNames","type":"bytes32[]"}],"payable":false,"type":"constructor"}]')
VotingContract = web3.eth.contract(abi);

contractInstance = VotingContract.at($("#server_address").val());

function voteForCandidate() {
if (confirm("Vote selected candidate ???")) {
  candidateName = $("#candidate").val();
  if(contractInstance.validCandidate.call(candidateName) == false)
  {
   window.alert("Please enter valid candidate name !");
   window.location="dashboard.php";
  }
  else
  {
   contractInstance.voteForCandidate(candidateName, {from: web3.eth.accounts[0]}, function() {
   // let div_id = candidates[candidateName];
   // $("#" + div_id).html(contractInstance.totalVotesFor.call(candidateName).toString());
   });
   //window.location="votedone.php";
  }  
 } 
}
