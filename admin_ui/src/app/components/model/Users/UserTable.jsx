import SortingTable from "../../shared/Tables/Sorting/SortingTable"
import {ConvertTime} from "../../../utils/Converters/TimeConverter"

function UserTable({items, sort, editHandler, removeHandler, sortHandler}) {

    const sortParts = sort.split('-')
    const orderBy = sortParts[0]
    const order = sortParts[1]

    const handleEdit = id => editHandler(id)
    const handleRemove = id => removeHandler(id)
    const handleSort = (orderBy, order) => sortHandler(orderBy, order)

    const tableItems = items.map(item => {
        return {
            id: item.id,
            properties: [
                {
                    tableName: 'Name',
                    sortId: 'name',
                    value: item.attributes.name
                },
                {
                    tableName: 'Email',
                    sortId: 'email',
                    value: item.attributes.email
                },
                {
                    tableName: 'Created At',
                    sortId: 'created_at',
                    value: ConvertTime(item.attributes.created_at)
                },
                {
                    tableName: 'Id',
                    sortId: 'id',
                    value: item.id
                },
            ]
        }
    })

    return (
        <SortingTable
            tableItems={tableItems}
            orderBy={orderBy}
            order={order}
            editHandler={handleEdit}
            removeHandler={handleRemove}
            sortHandler={handleSort}
        />
    )
}

export default UserTable