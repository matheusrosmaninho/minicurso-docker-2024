document.addEventListener('DOMContentLoaded', (event) => {
    const deleteButtons = document.querySelectorAll('.delete-button')

    deleteButtons.forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault()
            const id = e.target.getAttribute('data-id')
            const line = e.target.parentNode.parentNode
            const productName = line.querySelector('.product-name').innerText
            const confirmation = confirm(`Deseja realmente deletar o produto ${productName}?`)

            if (!confirmation) return

            try {
                const response = await fetch('deletar.php', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${id}`
                })

                if (!response.ok) {
                    const data = await response.json()
                    console.error('Erro ao deletar produto:', data.error)
                } else {
                    console.log('Produto deletado com sucesso')
                    line.remove()
                }
            } catch (error) {
                console.error('Erro ao deletar produto')
                console.error(error)
            }
        })
    })
})